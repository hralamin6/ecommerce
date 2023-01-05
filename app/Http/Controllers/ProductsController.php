<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use Doctrine\DBAL\Query\QueryException;
use App\Http\Requests\ProductsStoreRequest;
use App\Http\Requests\ProductsUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Auth\Access\AuthorizationException;

class ProductsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     * @throws AuthorizationException
     */
    public function index (Request $request)
    {
        $this->authorize ('view-any', Products::class);

        $search = $request->get ('search', '');

        $allProducts = Products::query ()
            ->with ('category:id,name')
            ->when ($search, function ($query) use ($search) {
                $query->search ($search);
            })
            ->latest ()
            ->paginate (15);

        return view ('app.all_products.index', compact ('allProducts', 'search'));
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     * @throws AuthorizationException
     */
    public function create (Request $request)
    {
        $this->authorize ('create', Products::class);

        $categories = Category::pluck ('name', 'id');
        $colors = DB::table ('colors')->get ();

        return view ('app.all_products.create', compact ('categories', 'colors'));
    }

    /**
     * @param ProductsStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     * @throws AuthorizationException|\Throwable
     */
    public function store (ProductsStoreRequest $request)
    {
        $this->authorize ('create', Products::class);
        $validated = $request->validated ();
        if ($request->hasFile ('thumbnail_img')) {
            $validated['thumbnail_img'] = $request
                ->file ('thumbnail_img')
                ->store ('products');
        }
        if ($request->hasFile ('gallery')) {
            foreach ($request->gallery as $imageData) {
                $file_links[] = $imageData->store ('products');
            }
            $validated['gallery'] = json_encode ($file_links);
        }


        $validated['slug'] = Str::slug ($validated['name']);
        if ($request->is_variant) {
            $validated['colors'] = json_encode ($validated['colors']);
            $variant_stock = $this->generateVariations ($request, $validated);
        }
        DB::beginTransaction ();
        try {
            $products = Products::create ($validated);
            if ($request->is_variant) {
                $products->variations ()->createMany ($variant_stock);
            }
            DB::commit ();
            return redirect ()
                ->route ('all-products.edit', $products)
                ->withSuccess (__ ('crud.common.created'));
        } catch (QueryException $queryException) {
            DB::rollBack ();
            return redirect ()->back ()->with ('error', $queryException->getMessage ())->withInput ();
        }


    }

    /**
     * @param \App\Http\Requests\ProductsStoreRequest $request
     * @param array                                   $validated
     *
     * @return array
     */
    public function generateVariations (Request $request, array $validated): array
    {

        $variations = $request->except (array_keys ($validated));
        unset($variations['_token']);
        unset($variations['_method']);
        $variant_stock = [];
        foreach (array_chunk ($variations, 2, true) as $variation) {
            $key = array_keys ($variation)[0];
            $values = array_values ($variation);
            $skuArray = explode ('_', $key);
            array_splice ($skuArray, -1);
            $sku = implode ('_', $skuArray);
            $variant_stock[] = [ 'sku' => $sku, 'quantity' => $values[0], 'price' => $values[1] ];
        }


        return $variant_stock;
    }

    /**
     * @param Request  $request
     * @param Products $products
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     * @throws AuthorizationException
     */
    public
    function show (Request $request, Products $products)
    {
        $this->authorize ('view', $products);

        return view ('app.all_products.show', compact ('products'));
    }

    /**
     * @param Request  $request
     * @param Products $products
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     * @throws AuthorizationException
     */
    public
    function edit (Request $request, Products $products)
    {
        $this->authorize ('update', $products);

        $categories = Category::pluck ('name', 'id');
        $colors = DB::table ('colors')->get ();
        return view ('app.all_products.edit', compact ('products', 'categories', 'colors'));
    }

    /**
     * @param ProductsUpdateRequest $request
     * @param Products              $products
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public
    function update (ProductsUpdateRequest $request, Products $products)
    {
        $this->authorize ('update', $products);

        $validated = $request->validated ();

        if ($request->hasFile ('gallery')) {
            if ($products->gallery) {
                foreach (json_decode ($products->gallery) as $imageData) {
                    Storage::delete ($imageData);
                }
            }
            foreach ($request->gallery as $imageData) {
                $file_links[] = $imageData->store ('products');
            }
            $validated['gallery'] = json_encode ($file_links);
        }

        if ($request->hasFile ('thumbnail_img')) {
            if ($products->thumbnail_img) {
                Storage::delete ($products->thumbnail_img);
            }

            $validated['thumbnail_img'] = $request
                ->file ('thumbnail_img')
                ->store ('products');
        }
        if ($request->is_variant) {
            $validated['colors'] = json_encode ($validated['colors']);
            $variant_stock = $this->generateVariations ($request, $validated);
        }

        DB::beginTransaction ();
        try {
            $products->update ($validated);
            if ($request->is_variant) {
                $products->variations ()->delete ();
                $products->variations ()->createMany ($variant_stock);
            }
            DB::commit ();
            return redirect ()
                ->route ('all-products.edit', $products)
                ->withSuccess (__ ('crud.common.created'));
        } catch (QueryException $queryException) {
            DB::rollBack ();
            return redirect ()->back ()->with ('error', $queryException->getMessage ())->withInput ();
        }

    }

    /**
     * @param Request  $request
     * @param Products $products
     *
     * @return Response
     * @throws AuthorizationException
     * @throws AuthorizationException
     */
    public
    function destroy (Request $request, Products $products)
    {
        $this->authorize ('delete', $products);

        if ($products->gallery) {
            foreach (json_decode ($products->gallery) as $imageData) {
                Storage::delete ($imageData);
            }
        }

        if ($products->thumbnail_img) {
            Storage::delete ($products->thumbnail_img);
        }

        $products->delete ();

        return redirect ()
            ->route ('all-products.index')
            ->withSuccess (__ ('crud.common.removed'));
    }
}
