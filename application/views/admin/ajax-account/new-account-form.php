<h3>Create New Account</h3>
<form action="" method="post" class="form-horizontal" id="new-account-detail">
    <input type="hidden" name="reqid" value="<?php echo isset($req->id) ? $req->id: ''; ?>">
    <fieldset>
    <legend>Account Information</legend>
    <table class="inputtable2">
        <tr class="inputrow">
            <td>
                <label>First Name</label>
                <input type="text" name="userfirstname" value="<?php echo (empty($req) ? '' : $req->firstname);?>" >
            </td>
            <td>
                <label>Last Name</label>
                <input type="text" name="userlastname" value="<?php echo (empty($req) ? '' : $req->lastname);?>"  >
            </td>
            <td>
                <label>Email</label>
                <input type="text" name="useremail" value="<?php echo (empty($req) ? '' : $req->email);?>"  >
            </td>
            <td>
                <!-- <label>Username</label>
                <input type="text" name="username" id="username" value="<?php echo (empty($username) ? '' : $username);?>" readonly> -->
            </td>
        </tr>
    </table>
    </fieldset>
    <fieldset>
    <legend>Client Information</legend>
    <table class="inputtable2">
        <tr class="inputrow">
            <td>
                <label>Business Name</label>
                <input type="text" name="businessname" value="<?php echo (empty($req) ? '' : $req->businessname);?>" required>
            </td>
            <td>
                <label>City</label>
                <input type="text" name="city" value="<?php echo (empty($req) ? '' : $req->city);?>"  >
            </td>
             <td>
                <label>Address</label>
                <input type="text" name="address" value="<?php echo (empty($req) ? '' : $req->address);?>"  >
            </td>
            <td>
                <label>Landmark</label>
                <input type="text" name="landmark" value="<?php echo (empty($req) ? '' : $req->landmark);?>"  >
            </td>
        </tr>
        <tr class="inputrow">
            <td>
                <label>First Name</label>
                <input type="text" name="firstname" value="<?php echo (empty($req) ? $req->firstname : $req->firstname);?>" >
            </td>
            <td>
                <label>Last Name</label>
                <input type="text" name="lastname" value="<?php echo (empty($req) ? $req->lastname : $req->lastname);?>"  >
            </td>
            <td>
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo (empty($req) ? $req->phone : $req->phone);?>"  >
            </td>
            <td>
                <label>Mobile</label>
                <input type="text" name="mobile" value="<?php echo (empty($req) ? $req->mobile : $req->mobile);?>"  >
            </td>
        </tr>
        <tr>
            <td>
                <label>Email</label>
                <input type="text" name="email" value="<?php echo (empty($req) ? $req->email : $req->email);?>"  >
            </td>
        </tr>
    </table>
</form>
</fieldset>
<div class="form-group form-actions">
    <div class="col-md-9">
        <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="createaccount" id="create-new-account">Create Account</button>
    </div>
</div>
<div class="clearfix"></div>