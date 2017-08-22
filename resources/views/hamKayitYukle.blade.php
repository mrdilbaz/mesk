<html>
    <head>
        
    </head>
    <body>
        <div class="container">

        
        {!! Form::open(['url'=>'hamKayitYukle','files'=>true]) !!}
        
            {!! Form::label('İsim', 'Ham Kayit İsmi', []) !!} 
            {!! Form::text('İsim',"",[]) !!}
            <br/>
            {!! Form::label('Tip', 'Kayit Türü', []) !!} 
            {!! Form::select("Tip", $tipler, "", []) !!}
            <br/>
            {!! Form::file("Dosya", []) !!}
            <br/>
            {!! Form::submit("Yükle", []) !!}
    
        {!! Form::close() !!}
        
        </div>
    </body>
</html>