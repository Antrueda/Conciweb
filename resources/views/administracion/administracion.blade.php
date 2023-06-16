@extends('../mainUsrWeb')

@section('title','ADMINISTRACION')
@section('content')

<div class="card-body">
  
  <p class="fs-5 text-center color_titulo fw-bold">SELECCIONE LA ADMINISTRACCION DE INTERÉS</p>

  <div class="row">
      <div class="col-sm-6">
          <div class="card rounded-3 shadow card-acceso">
              <div class="card-body">
                <p class="fs-6 color_titulo fw-bold">Temas y subtemas</p>
                <p class="fs-6">Administraccion de temas y subtemas</p>
                  <center><a href="{{ route('tema')}}"class="btn btn-success">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                      </svg>  
                      Ingresar</a>
                  </center>
              </div>
          </div>
      </div>
      <div class="col-sm-6">
          <div class="card rounded-3 shadow card-acceso">
              <div class="card-body">
                <p class="fs-6 color_titulo fw-bold">Par&aacute;metro</p>
                <p class="fs-6">Administraccion de Par&aacute;metro</p>
                  <center><a href="{{ route('parametro')}}" class="btn btn-success">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                      </svg>  
                      Ingresar</a>
                  </center>
              </div>
          </div>
      </div>
  </div>
  <div class="row mt-5">
      <div class="col-sm-6">
          <div class="card rounded-3 shadow card-acceso">
              <div class="card-body">
                <p class="fs-6 color_titulo fw-bold">Salario Minimo</p>
                <p class="fs-6">Cambiar Salario Minimo</p>
                  <center><a href="{{ route('salario.editar',1) }}" class="btn btn-success">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                      </svg>  
                      Ingresar</a>
                  </center>
              </div>
          </div>
      </div>
      <div class="col-sm-6">
          <div class="card rounded-3 shadow card-acceso">
              <div class="card-body">
                <p class="fs-6 color_titulo fw-bold">Textos</p>
                <p class="fs-6">Administraccion de Textos</p>
                  <center><a href="{{ route('textos')}}" class="btn btn-success">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                      </svg>  
                      Ingresar</a>
                  </center>
              </div>
          </div>
      </div>
  </div>
  <div class="row mt-5">
      <div class="col-sm-6">
          <div class="card rounded-3 shadow card-acceso">
              <div class="card-body">
                <p class="fs-6 color_titulo fw-bold">Asuntos</p>
                <p class="fs-6">Administración de Asuntos</p>
                  <center><a href="{{ route('asuntomodulo')}}" class="btn btn-success">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                          <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                      </svg>  
                      Ingresar</a>
                  </center>
              </div>
          </div>
      </div>


    <div class="col-sm-6">
        <div class="card rounded-3 shadow card-acceso">
            <div class="card-body">
              <p class="fs-6 color_titulo fw-bold">Usuarios</p>
              <p class="fs-6">Administración de Usuarios Asignados</p>
                <center><a href="{{ route('asignafun')}}" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                    </svg>  
                    Ingresar</a>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5">
  <div class="col-sm-6">
      <div class="card rounded-3 shadow card-acceso">
          <div class="card-body">
            <p class="fs-6 color_titulo fw-bold">Estado Formulario</p>
            <p class="fs-6">Administración de Estado del Formulario</p>
              <center><a href="{{ route('estadoform.editar',1)}}" class="btn btn-success">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"></path>
                      <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"></path>
                  </svg>  
                  Ingresar</a>
              </center>
          </div>
      </div>
  </div>
</div>
</div>
@endsection
