    @extends('principal')
    @section('contenido')

    @if(Auth::check())
        @if(Auth::user()->idrol == 1)
            {{-- @include('plantilla.sidebaradministrador') --}}
        
            
        <template v-if="menu==0">
                {{-- <example-component></example-component> --}}
                <h1>Contenido del menú 0</h1>
            </template>
    
            <template v-if="menu==1">
                <categoria-component></categoria-component>
            </template>
    
            <template v-if="menu==2">
                <articulo-component></articulo-component>
            </template>
    
            <template v-if="menu==3">
                <h1>Contenido del menú 3</h1>
            </template>
    
            <template v-if="menu==4">
                <proveedor-component></proveedor-component>
            </template>
    
            <template v-if="menu==5">
                <h1>Contenido del menú 5</h1>
            </template>
    
            <template v-if="menu==6">
                <cliente-component></cliente-component>
            </template>
    
            <template v-if="menu==7">
                <user-component></user-component>
            </template>
    
            <template v-if="menu==8">
                <rol-component></rol-component>
            </template>
    
            <template v-if="menu==9">
                <h1>Contenido del menú 9</h1>
            </template>
    
            <template v-if="menu==10">
                <h1>Contenido del menú 10</h1>
            </template>
    
            <template v-if="menu==11">
                <h1>Contenido del menú 11</h1>
            </template>
    
            <template v-if="menu==12">
                <h1>Contenido del menú 12</h1>
            </template>
            

        @elseif (Auth::user()->idrol == 2)
            {{-- @include('plantilla.sidebarvendedor') --}}

             <template v-if="menu==5">
                <h1>Contenido del menú 5</h1>
            </template>
    
            <template v-if="menu==6">
                <cliente-component></cliente-component>
            </template>
            
            <template v-if="menu==10">
                    <h1>Contenido del menú 10</h1>
                </template>
        
                <template v-if="menu==11">
                    <h1>Contenido del menú 11</h1>
                </template>
        
                <template v-if="menu==12">
                    <h1>Contenido del menú 12</h1>
                </template>


        @elseif (Auth::user()->idrol == 3)
            {{-- @include('plantilla.sidebaralmacenero') --}}


            <template v-if="menu==1">
                    <categoria-component></categoria-component>
                </template>
        
                <template v-if="menu==2">
                    <articulo-component></articulo-component>
                </template>
        
                <template v-if="menu==3">
                    <h1>Contenido del menú 3</h1>
                </template>
        
                <template v-if="menu==4">
                    <proveedor-component></proveedor-component>
                </template>   

                <template v-if="menu==9">
                        <h1>Contenido del menú 9</h1>
                </template>

                <template v-if="menu==11">
                        <h1>Contenido del menú 11</h1>
                    </template>
            
                    <template v-if="menu==12">
                        <h1>Contenido del menú 12</h1>
                    </template>

        @else

        @endif

    @endif




    @endsection