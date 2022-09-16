<h1>Create an account</h1>

<form method="post" action="">
  <div class="row">
    <div class="mb-3 col">
      <label class="form-label">First name</label>
      <input name="firstName" type="text" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="mb-3 col">
      <label class="form-label">Last name</label>
      <input name="lastName" type="text" class="form-control">
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input name="email" type="email" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input name="password" type="password" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Password Repeat</label>
    <input name="confirmPassword" type="password" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>