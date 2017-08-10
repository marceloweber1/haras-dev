<?php 

include(__DIR__."/functions.php");
include(__DIR__."/actions.php");

?>
<table>
    <tr>
        <td>
            <h2><?php _e('Import Horses', 'import_abccmm') ?></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="horse_file" required="required" /> 
                <br /><input type="submit" value="<?php _e('Import', 'import_abccmm') ?>" />
            </form>
        </td>
        <td width="200"></td>
        <td>
            <h2><?php _e('Import Awards', 'import_abccmm') ?></h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="award_file" required="required" /> 
                <br /><input type="submit" value="<?php _e('Import', 'import_abccmm') ?>" />
            </form>
        </td>
    </tr>
    <tr>
        <td>
            <?php if($importouHorses) : ?>
                <table>
                    <tr>
                        <td><strong><?php _e('Total Imported', 'import_abccmm') ?></strong></td>
                        <td><?php echo $totalImportados ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php _e('Total Updated', 'import_abccmm') ?></strong></td>
                        <td><?php echo $totalAtualizados ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php _e('Total Existent', 'import_abccmm') ?></strong></td>
                        <td><?php echo $totalExistentes ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        </td>
        <td></td>
        <td>
            <?php if($importouAwards) : ?>
                <table>
                    <tr>
                        <td><strong><?php _e('Total Imported', 'import_abccmm') ?></strong></td>
                        <td><?php echo $totalImportados ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php _e('Total Updated', 'import_abccmm') ?></strong></td>
                        <td><?php echo $totalAtualizados ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php _e('Total Existent', 'import_abccmm') ?></strong></td>
                        <td><?php echo $totalExistentes ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        </td>
    </tr>
</table>



