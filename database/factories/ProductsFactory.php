<?php

    namespace Database\Factories;

    use App\Models\Brand;
    use App\Models\Category;
    use App\Models\Products;
    use Illuminate\Support\Str;
    use Illuminate\Database\Eloquent\Factories\Factory;


    class ProductsFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Products::class;

        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition(): array
        {
            $name = $this->faker->unique->sentence(2);
            $productImage = ['products/2lkntVPK9XEFmNSGcFUAeUULrxJc4V9sN5Xnx4oa.jpg', 'products/BstXaKrTIQ0lTOoI5OOFvYWluuQP2d63TIj8pqmy.jpg'];
            return [
                'name'           => ucwords($name),
                'slug'           => Str::slug($name),
                'description'    => $this->faker->sentence(15),
                'thumbnail_img'  => $productImage[array_rand ($productImage)],
                'gallery'        => json_encode($productImage),
                'sale_price'     => 50,
                'purchase_price' => 10,
                'stock'          => $this->faker->randomNumber(2),
                'status'         => 1,
                'is_flash'       => 1,
                'is_feature'     => 1,
                'rating'         => rand(0, 5),
                'point'          => rand(10, 100),
                'total_sale'     => $this->faker->randomNumber(2),
                'discount'       => $this->faker->randomFloat(2, 0, 10),
                'discount_type'  => 'percentage',
                'category_id'    => Category::factory(),
                'brand_id'       => Brand::factory(),
            ];
        }
    }
