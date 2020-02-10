
<form action="<?php echo base_url($url) ?>" method="post" class="form-horizontal" id="account-detail">
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
                <label>Username</label>
                <input type="text" name="username" id="username" value="<?php echo (empty($username) ? '' : $username);?>" readonly>
            </td>
        </tr>
    </table>
    </fieldset>
    <fieldset>
    <legend>Client Information</legend>
    <table class="inputtable2">
        <input type="hidden" name="clientid" value="<?php echo (empty($client) ? '' : $client->id);?>" >
        <tr class="inputrow">
            <td>
                <label>Business Name</label>
                <input type="text" name="businessname" id="businessname" value="<?php echo (empty($client) ? '' : $client->businessname);?>" required>
            </td>
            <td>
                <label>City</label>
                <input type="text" name="city" id="city" value="<?php echo (empty($client) ? '' : $client->city);?>"  >
            </td>
             <td>
                <label>Address</label>
                <input type="text" name="address" id="address" value="<?php echo (empty($client) ? '' : $client->address);?>"  >
            </td>
            <td>
                <label>Landmark</label>
                <input type="text" name="landmark" id="landmark" value="<?php echo (empty($client) ? '' : $client->landmark);?>"  >
            </td>
        </tr>
        <tr class="inputrow">
            <td>
                <label>First Name</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo (empty($client) ? $req->firstname : $client->firstname);?>" >
            </td>
            <td>
                <label>Last Name</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo (empty($client) ? $req->lastname : $client->lastname);?>"  >
            </td>
            <td>
                <label>Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo (empty($client) ? $req->phone : $client->phone);?>"  >
            </td>
            <td>
                <label>Mobile</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo (empty($client) ? $req->mobile : $client->mobile);?>"  >
            </td>
        </tr>
        <tr>
            <td>
                <label>Email</label>
                <input type="text" name="email" id="email" value="<?php echo (empty($client) ? $client->email : $client->email);?>"  >
            </td>
        </tr>
    </table>
</form>
</fieldset>
<div class="form-group form-actions">
    <div class="col-md-9">
        <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="createaccount" id="create-account">Create Account</button>
    </div>
</div>
<div class="clearfix"></div>