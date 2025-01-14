<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento</title>
</head>
<body>
    <style>
        h1 { font-family: TimesNewRoman; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18px; } h3 { font-family: TimesNewRoman, Times New Roman, Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px; } p { font-family: TimesNewRoman, Times New Roman, Times, Baskerville, Georgia, serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px; } blockquote { font-family: TimesNewRoman, Times New Roman, Times, Baskerville, Georgia, serif; font-size: 21px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px; } pre { font-family: TimesNewRoman, Times New Roman, Times, Baskerville, Georgia, serif; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18.5667px; }
         /** Define the margins of your page **/
         @page {
                margin: 113,44px 113,44px;
            }

            header {
                position: fixed;
                top: -113,44px;
                left: -113,44px;
                right: -113,44px;
                height: 113,44px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
            .page_break { margin-bottom: 125px; }

            .firma {
                
                position: absolute; 
                
                bottom: 115px; 
                left: 0px; 
                right: 0px;
                height: 100px; 
                display:inline-block;
                /** Extra personal styles **/
               
                text-align: center;
                line-height: 35px;
            }

            .referencias {
                
                position: absolute; 
                
                bottom: -30px; 
                
                display:inline-block;
                /** Extra personal styles **/
               
                text-align: left;
                line-height: 35px;
            }
            .referenciafont{
                font-size: 13px;
            }

            .para{

                display:inline-block; 
                position: relative;
                
                left: 96px;
               
            }
            .receptor
            {
                display:inline-block; 
                position: relative;
                top: 10px;
                left: 596px;  
            }
    </style>
      <!-- 
    <header>
        <img class="img-thumbnail img-fluid rounded" style="width: 100%;" src="images/header.jpg" alt="Error Imagen no encontrada"/>    
    </header>
    -->
    @php

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $mesnumero=date('m')-1;
    $mes=$meses[$mesnumero];
    @endphp
    <h1 align="right">Tulcán, {{ @date('d') }} de {{ $mes }} del {{ @date('Y') }}</h1>
    <h1 align="right"><b>{{ $tipo }} Nro {{ $numeracion }}</b></h1>
    <br>
    
    @php
    $i=-1;    
    @endphp
    @if (@isset($receptores))
        
    
    
       @foreach ($receptores as $receptor )
       @php
       
           $consulta1=\DB::table('treatments')->where('id', '=', $receptor->treatment_id)->first();
           $consulta2=\DB::table('positions')->where('id', '=', $receptor->position_id)->first();
           $consulta3=\DB::table('departaments')->where('id', '=', $receptor->departament_id)->first();
           $titulo=$consulta1->name;
           $posicion=$consulta2->name;
           $departamento=$consulta3->name;
      
       
       @endphp
       @if ($i==-1)
       <h1 class="receptor"><b>PARA:  </b></h1>  
       @else
       <h1 class="receptor" style="color:white;"><b>PARA:  </b></h1>
       @endif
        </h1><h1 class="receptor">{{ mb_strtoupper($titulo) }}  </h1><br>
       <h1  class="receptor"  style="color:white;"><b>PARA:  </b></h1><h1 class="receptor">{{ $receptor->name }} {{ $receptor->lastname }} </h1><br>


       
       <h1  class="receptor"  style="color:white;"><b>PARA:  </b></h1><h1 class="receptor"><b>  {{ $posicion }} DE {{ strtoupper($departamento) }}</b> </h1><br>
       @php
            $i++;
       @endphp
       @endforeach 
    @endif
   
    
    @if (@isset($receptores_departamentos))
        
    
       @foreach ($receptores_departamentos as $receptor_departamento )
       
       @php
           $Usuarios= \DB::table('users')
        ->join('departaments','users.departament_id','=','departaments.id')
        ->join('positions','positions.id','=','users.position_id')
        ->join('treatments','treatments.id','=','users.treatment_id')
        ->where('users.departament_id', '=', $receptor_departamento->id)
        
        ->select('departaments.name as Departamento','positions.name as posicion','treatments.name as titulo',
        'users.name as name','users.lastname as lastname','users.id as id')->get();
       @endphp

       @foreach ($Usuarios as $usuario)
       @if($usuario->id!=Auth::user()->id)
       @if ($i==-1)
       <h1 class="receptor"><b>PARA:  </b></h1>  
       @else
       <h1 class="receptor" style="color:white;"><b>PARA:  </b></h1>
       @endif
    </h1><h1 class="receptor">{{ mb_strtoupper($usuario->titulo) }}  </h1><br>
    <h1  class="receptor"  style="color:white;"><b>PARA:  </b></h1><h1 class="receptor"> {{ $usuario->name }} {{ $usuario->lastname }}</h1><br>
       
       <h1  class="receptor"  style="color:white;"><b>PARA:  </b></h1><h1 class="receptor"><b>  {{ $usuario->posicion }} DE {{ strtoupper($usuario->Departamento) }}</b> </h1><br>
       
       @php
            $i++;
       @endphp
       @endif
       @endforeach
       <!--La siguiente linea se usaba solo para imprimir el nombre de departamento 
       <h1 class="receptor">  UNIDAD DE {{ strtoupper($receptor_departamento->name) }}</h1>    <br>
       -->
       @endforeach 
    @endif
    
    
    <h1><b> OBJETO : {{ $objeto }}</b></h1>
    <br>
    <br>
    
    <h1 class="page_break">{!! $cuerpo !!}</h1>
    @php
                $posicion_emisor=\DB::table('positions')->where('id', '=',  Auth::user()->position_id)->first();
                $departamento_emisor=\DB::table('departaments')->where('id', '=',  Auth::user()->departament_id)->first();

        
    @endphp
    <div class="firma">
        <h1>Atentamente,</h1>
       
        <br>
       
        @php
            $Titulo= \DB::table('treatments')->where('id', '=', Auth::user()->treatment_id)->first();
        @endphp

    <h1>______________</h1>
    <h1>{{ $Titulo->abbreviation }}. {{ $apellido }} {{ $nombre }} </h1>
    <h1><b>{{ strtoupper($posicion_emisor->name)}} DE {{ strtoupper($departamento_emisor->name)}}</b> </h1>
    
    </div >
    @if (isset($documentoR))
        <div class="referencias">
            <p class="referenciafont" >Referencias: En respuesta a {{ $typoR->name}} {{ $documentoR->number }}</p>
        </div>
   
    

    @endif
    
</body>
</html>