<?php
$pdo = new PDO('mysql: host=localhost; dbname=kamennrider', 'root', '');
$sql1 = $pdo->query("SELECT *FROM tbl_era");
$dataX = $sql1->fetchAll(PDO::FETCH_ASSOC);
if(isset($_GET['kamenid'])){
$sql = "SELECT *FROM tbl_kamenrider km,tbl_era e  WHERE km.kamen_era = e.era_id and km.kamen_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $_GET['kamenid']);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode($row);
?>
<input type="hidden" value="<?php echo $row[0]['kamen_id'] ?>" name="kamen_id">
<label for="" class="labelkamen">kamenridername</label>
<input type="text" name="kamen_name" id="" value="<?php echo $row[0]['kamen_name'] ?>" required>
<label for="" class="labelkamen">kamenriderdaystart</label>
<input type="date" name="kamen_datestart" id="" value="<?php echo $row[0]['kamen_datestart'] ?>" required>
<label for="" class="labelkamen">kamenriderdayend</label>
<input type="date" name="kamen_datesend" id="" value="<?php echo $row[0]['kamen_datesend'] ?>" required>
<label for="" class="labelkamen">kamenriderimg</label>
<input type="hidden" name="kamen_img" value="<?php echo $row[0]['kamen_img'] ?>">
<input type="file" accept="image/png, image/gif, image/jpeg,image/webp" name="fileimg" id="">
<label for="" class="labelkamen">kamenriderlogo</label>
<input type="hidden" name="kamen_logo" value="<?php echo $row[0]['kamen_logo'] ?>">
<input type="file" accept="image/png, image/gif, image/jpeg,image/webp" name="filelogo" id="">
<label for="" class="labelkamen">kamenriderep</label>
<input type="number" name="kamen_ep" id="" value="<?php echo $row[0]['kamen_ep'] ?>" required>
<label for="" class="labelkamen">kamenriderera</label>
<select name="kamen_era" required>
    <option value="<?php echo $row[0]['era_id'] ?>"><?php echo $row[0]['era_name'] ?></option>
    <?php foreach($dataX as $key=>$value){ ?>
    <option value="<?php echo $dataX[$key]['era_id'] ?>"><?php echo $dataX[$key]['era_name'] ?></option>
    <?php } ?>
</select>
<div class="cardbtn">
    <button type="submit">SUBMIT</button>
    <button type="reset">RESET</button>
</div>
<?php }else if(isset($_GET['kamenadd'])){ ?>
    <label for="" class="labelkamen">kamenridername</label>
    <input type="text" name="kamen_name" id="" value="" required>
    <label for="" class="labelkamen">kamenriderdaystart</label>
    <input type="date" name="kamen_datestart" id="" value="" required>
    <label for="" class="labelkamen">kamenriderdayend</label>
    <input type="date" name="kamen_datesend" id="" value="" required>
    <label for="" class="labelkamen">kamenriderimg</label>
    <input type="file" accept="image/png, image/gif, image/jpeg,image/webp" name="fileimg" id="" required>
    <label for="" class="labelkamen">kamenriderlogo</label>
    <input type="file" accept="image/png, image/gif, image/jpeg,image/webp" name="filelogo" id="" required>
    <label for="" class="labelkamen">kamenriderep</label>
    <input type="number" name="kamen_ep" id="" value="" required>
    <label for="" class="labelkamen">kamenriderera</label>
    <select name="kamen_era">
        <?php foreach($dataX as $key=>$value){ ?>
        <option value="<?php echo $dataX[$key]['era_id'] ?>"><?php echo $dataX[$key]['era_name'] ?></option>
        <?php } ?>
    </select>
    <div class="cardbtn">
    <button type="submit">SUBMIT</button>
    <button type="reset">RESET</button>
</div>
<?php }else if(isset($_GET['eraid'])){ 
    $sqle = "SELECT *FROM tbl_era WHERE era_id  = ?";
    $stmte = $pdo->prepare($sqle);
    $stmte->bindParam(1, $_GET['eraid']);
    $stmte->execute();
    $rowe = $stmte->fetchAll(PDO::FETCH_ASSOC);
?>
    <input type="hidden" value="<?php echo $rowe[0]['era_id'] ?>" name="era_id">
    <label for="" class="labelkamen">era_name</label>
    <input type="text" name="era_name" id="" value="<?php echo $rowe[0]['era_name'] ?>" required>
    <label for="" class="labelkamen">era_description</label>
    <textarea name="era_description" id="" cols="30" rows="10" required><?php echo $rowe[0]['era_description'] ?></textarea>
    <label for="" class="labelkamen">kamenriderlogo</label>
    <input type="hidden" name="era_img" value="<?php echo $rowe[0]['era_img'] ?>">
    <input type="file" accept="image/png, image/gif, image/jpeg,image/webp" name="fileimg" id="">
    <div class="cardbtn">
        <button type="submit">SUBMIT</button>
        <button type="reset">RESET</button>
    </div>
<?php }else if(isset($_GET['eraadd'])){ ?>
    <label for="" class="labelkamen">era_name</label>
    <input type="text" name="era_name" id="" value="" required>
    <label for="" class="labelkamen">era_description</label>
    <textarea name="era_description" id="" cols="30" rows="10" required></textarea>
    <label for="" class="labelkamen">kamenriderlogo</label>
    <input type="file" accept="image/png, image/gif, image/jpeg,image/webp" name="fileimg" id="" required>
    <div class="cardbtn">
        <button type="submit">SUBMIT</button>
        <button type="reset">RESET</button>
    </div>
<?php } ?>