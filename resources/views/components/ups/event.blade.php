<div class="card">
    <div class="card-header card-header-icon card-header-warning">
        <div class="card-icon">
            <i class="material-icons">{{ $upsEvent->getIcon() }}</i>
        </div>
        <h5 class="pt-3 text-dark">{{ $upsEvent->description }}</h5>
    </div>
    <div class="card-footer">
        <div class="stats">
            <i class="material-icons">access_time</i> {{ $upsEvent->date_time }}
        </div>
    </div>
</div>