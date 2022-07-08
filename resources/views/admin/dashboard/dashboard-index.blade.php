@section('title', 'Dashboard')

@section('breadcrumb')
<ol class="breadcrumb breadcrumb-links">
    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">dashboard</li>
</ol>
@endsection

<div class="container-fluid mt--6">
    <!-- Card stats -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <livewire:components.card-stats title="Total traffic" info="350,897" color="red" icon="fa-chart-line"/>
        </div>
        <div class="col-xl-3 col-md-6">
            <livewire:components.card-stats title="New users" info="2,356" color="orange" icon="fa-user-plus"/>
        </div>
        <div class="col-xl-3 col-md-6">
            <livewire:components.card-stats title="Sales" info="924" color="green" icon="fa-sack-dollar"/>
        </div>
        <div class="col-xl-3 col-md-6">
            <livewire:components.card-stats title="Performance" info="49,65%" color="info" icon="fa-tachometer"/>
        </div>
    </div>
</div>
