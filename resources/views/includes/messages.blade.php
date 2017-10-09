  @if(count($errors) > 0)

                  @foreach($errors->all() as $error)

                        <p class="alert alert-danger">{{ $error }}</p>
                  @endforeach
 @endif

@switch(session())
  @case(session()->has('message'))

                

                        <p class="alert alert-success">{{ session('message') }}</p>
            
 @break

  @case(session()->has('del'))

                

                        <p class="alert alert-danger">{{ session('del') }}</p>
             
        @break
 @endswitch