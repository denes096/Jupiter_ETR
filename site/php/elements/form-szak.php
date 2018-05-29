<?php
$szakok = getHallgatoSzakok($_SESSION['username']);
?>

<select id="szak-form-select" name="szak">
    <option name="">Válassz...</option>
<?php
    while($aszak = mysqli_fetch_Assoc($szakok)) {
        echo "<option name=\"" . $aszak['SzakAzonosito'] . "\"" . ($szak == $aszak['SzakAzonosito'] ? " selected " : "") . ">" . $aszak['SzakAzonosito'] . "</option>\n";
    }
?>
</select>

<script>
$('#szak-form-select').change(function() {
    $(this).closest('form').submit();
});
</script>
