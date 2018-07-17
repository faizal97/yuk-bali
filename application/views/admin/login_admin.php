<style>
.button-btn{
	background-color: white;
    border: none;
    color: black;
    padding: 5px 207px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
	border-radius:12px;
	border: 2px solid #008CBA;

}
.btn2:hover{
    background-color:#3F729B ; 
    color: white; 
    border: 2px solid #008CBA;
}
</style>

<div class="container" style="margin-top:5px;">
<div class="card animated flipInY border-dark mb-3" style="width: 50%;margin-left:25%; margin-top:10%; padding:22px">
  <div class="card-header" style="background-color:#3F729B; color:white"><h2 align="center">Masuk Administrator</h2></div>
  <div class="card-body text-primary">
    <div class="card-text">

<form action="<?php echo base_url('admin/proses_masuk.html') ?>" method="post">
  <div class="form-group">
    <label style="color:black">Username</label>
    <input type="text" class="form-control" name="username_admin" autofocus placeholder="Masukkan username">
  </div>

    <div class="form-group">
    <label style="color:black">Kata Sandi</label>
    <input type="password" class="form-control" name="password_admin"  placeholder="Masukkan Kata Sandi">
  </div>

<div class="btn" style="margin-top:10px">
<button type="submit" class="button-btn btn2" style="margin-left:-10px">Masuk</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
