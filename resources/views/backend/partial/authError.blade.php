<div class="row align-items-center">
  <div class="col-md-12">
    @if ($errors->has('email'))
      <div class="alert alert-danger">
        <strong>Attention!</strong> Credentials do not match.
      </div>
    @endif
  </div>
</div>
