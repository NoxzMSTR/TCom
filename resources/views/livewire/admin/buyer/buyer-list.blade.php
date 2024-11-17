@extends('admin.layout.master')

@section('content')
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>List</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            @livewire('admin.buyer.buyer-datatable')
        </div>
        <!--end::Card body-->
    </div>
    @livewire('admin.buyer.buyer-modal')
@endsection
@section('js')
    <script>
        setTimeout(() => {
            KTApp.hidePageLoading();
            KTComponents.init();
        }, 1000);
    </script>
@endsection
