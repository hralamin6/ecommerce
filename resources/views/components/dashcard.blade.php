<div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
        <div class="card-icon shadow-{{ $bg ?? 'primary' }} bg-{{ $bg ?? 'primary' }}">
            <i class="fas fa-{{ $icon ?? 'dollar-sign' }}"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>{{ $title ?? "Admin counter" }}</h4>
            </div>
            <div class="card-body">
                {{ $count ?? 0 }}
            </div>
        </div>
    </div>
</div>