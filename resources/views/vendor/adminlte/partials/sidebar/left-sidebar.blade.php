<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                <?php
                    // dd($adminlte->menu('sidebar'));
                    $params = [];
                   
                       /* if(Auth::user()->tf == 1) { 
                            $params['testefinal']    = $adminlte->menu('sidebar')[17];
                            $params['tf']    = $adminlte->menu('sidebar')[18];
                        } else {
                    
                        
                        $params['hc']   = $adminlte->menu('sidebar')[0];
                        
                        if(Auth::user()->perfil != 0){
                            $params['ft']    = $adminlte->menu('sidebar')[1];
                            $params['novo_tec']    = $adminlte->menu('sidebar')[2];
                        }
                        $params['apontar']    = $adminlte->menu('sidebar')[3];
                        $params['alterar_apontamento']     = $adminlte->menu('sidebar')[4];
                          $params['tabulador']     = $adminlte->menu('sidebar')[5];
                            $params['tabulador-instalacao']     = $adminlte->menu('sidebar')[6];
                            $params['tabulador-operadores']     = $adminlte->menu('sidebar')[7];
                      // VENDAS
                        $params['config']    = $adminlte->menu('sidebar')[8];
                        if(Auth::user()->perfil != 0){
                            $params['usuarios']     = $adminlte->menu('sidebar')[9];
                        }
                      
                        
                        $params['3logs']    = $adminlte->menu('sidebar')[21];
                        $params['config1']    = $adminlte->menu('sidebar')[10];
                          
                        
                        $params['os']    = $adminlte->menu('sidebar')[11];
                        $params['sla_bluephone']    = $adminlte->menu('sidebar')[12];
                        $params['repetido_bluephone']    = $adminlte->menu('sidebar')[13];
                        $params['logs']    = $adminlte->menu('sidebar')[14];
                        $params['1sla_bluephone']    = $adminlte->menu('sidebar')[15];
                        $params['1repetido_bluephone']    = $adminlte->menu('sidebar')[16];
                        $params['testefinal']    = $adminlte->menu('sidebar')[17];
                        $params['tf']    = $adminlte->menu('sidebar')[18];
                        
                        $params['1logs']    = $adminlte->menu('sidebar')[19];
                        $params['2logs']    = $adminlte->menu('sidebar')[20];
                        
                    }*/
                ;?>
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
