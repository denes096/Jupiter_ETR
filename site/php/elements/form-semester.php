<?php
$semesters = 0;
if($_SESSION['jog'] == 0) {
    // Hallgató
        $semesters = getHallgatoFelevek($_SESSION['username']);
    } else if ($_SESSION['jog'] == 1) {
    // Oktató
        $semesters = getOktatoFelevek($_SESSION['username']);
    } else if ($_SESSION['jog'] == 2) {
    // Admin
        $semesters = getFelevek();
    }
?>

<select id="semester-form-select" name="semester">
<?php
    while($felev = mysqli_fetch_Assoc($semesters)) {
    echo "<option name=\"" . $felev['Szemeszter'] . "\"" . ($semester == $felev['Szemeszter'] ? " selected " : "") . ">" . $felev['Szemeszter'] . "</option>\n";
    }
?>
</select>

<script>
$('#semester-form-select').change(function() {
    $(this).closest('form').submit();
});
</script>
