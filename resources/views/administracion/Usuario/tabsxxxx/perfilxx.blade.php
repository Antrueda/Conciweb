<div class="card card-success card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img class="profile-user-img img-fluid img-circle" src="{{ asset('adminlte/dist/img/avatar5.png') }} " alt="User profile picture">
    </div>
    <h3 class="profile-username text-center">
      {{ $todoxxxx['usuariox']->s_primer_nombre }}
      {{ $todoxxxx['usuariox']->s_segundo_nombre }}
      {{ $todoxxxx['usuariox']->s_primer_apellido }}
      {{ $todoxxxx['usuariox']->s_segundo_apellido }}</h3>
    <p class="text-muted text-center">{{ $todoxxxx['usuariox']->sis_cargo->s_cargo }}</p>
    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Teléfono</b>
        <a class="float-right">{{ $todoxxxx['usuariox']->s_telefono }}</a>
      </li>
      <li class="list-group-item">
        <b>E-mail</b>
        <a class="float-right">{{ $todoxxxx['usuariox']->email }}</a>
      </li>
      <li class="list-group-item">
        <b>Vinculación</b>
        <a class="float-right">{{ $todoxxxx['usuariox']->vinculacion->nombre }}</a>
      </li>
      <li class="list-group-item">
        <b>Tarjeta Profesional</b>
        <a class="float-right">{{ $todoxxxx['usuariox']->s_matriculap }}</a>
      </li>
    </ul>
  </div>
</div>
