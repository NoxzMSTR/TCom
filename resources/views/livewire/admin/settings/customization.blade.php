<div>
    <!--begin::Navbar-->
    @include('livewire.admin.settings.partials.customization.header')
    <!--end::Navbar-->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="customize_general" role="tabpanel" wire:ignore.self>
            <!--begin::Basic info-->
            @include('livewire.admin.settings.partials.customization.general')
            <!--end::Basic info-->
        </div>
        <div class="tab-pane fade" id="customize_slider" role="tabpanel" wire:ignore.self>
            <!--begin::Basic info-->
            @include('livewire.admin.settings.partials.customization.slider')
            <!--end::Basic info-->
        </div>
    </div>

</div>
@script
    <script>
        setTimeout(() => {
            KTApp.hidePageLoading();
            initEl();
        }, 1000);

        $wire.on('show-loader', () => {
            KTApp.showPageLoading();
        });

        $wire.on('hide-loader', (e) => {
            setTimeout(() => {
                KTApp.hidePageLoading();
                initEl(e);
            }, 1000);

        });

        function initEl(e = null) {
            KTComponents.init();
        }
    </script>
@endscript
