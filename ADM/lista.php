<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include_once ('../navbar.php');
    ?>
    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $slq = mysqli_query($conexao, "SELECT * FROM professor");
                while ($prof = mysqli_fetch_array($slq)) {
                    if ($prof['prof_isActive'] == true) { ?>
                        <tr>
                            <td><?php echo $prof['prof_cod']; ?></td>
                            <td><?php echo $prof['prof_nome']; ?></td>
                            <td><?php echo $prof['prof_cargo']; ?></td>
                        </tr>
                    <?php }
                }
                ; ?>
            </tbody>
        </table>
    </div>
</body>

</html>