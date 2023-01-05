@props(['search'])
<div class="searchbar mb-3">
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="input-group">
                    <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                    />
                    <div class="input-group-append">
                        <button
                                type="submit"
                                class="btn btn-primary"
                        >
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            {{ $create ?? null}}
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless table-sm table-hover">
                {{ $slot }}
            </table>
        </div>
    </div>
    <div class="card-footer ml-auto">
        {{ $pagination }}
    </div>
</div>