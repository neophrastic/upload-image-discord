<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


require 'koneksi.php';
$stmt = "SELECT * FROM data";
$datas = mysqli_query($conn,$stmt);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label for="title">TItle:   </label>
    <input type="text" name="title" id="title">
    <label for="image">Image</label>
    <input type="file" name="image" id="file">
    <button id="btn">Submit</button>
    <br>
    <br><br><br><br><br>
    <table border="2">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php while($data= mysqli_fetch_array($datas)){ ?>
                <tr>
                    <td><?= $data['text'] ?></td>
                    <td>
                        <img src="<?= $data['image'] ?>" alt="" width="200">
                    </td>
                </tr>
                
            <?php } ?>
        </tbody>
    </table>

    


    <form action="upload.php" method="post" id="form">
        <input type="hidden" name="title" value="" id="title-hide">
        <input type="hidden" name="url" value="" id="url-hide">
    </form>
     
    <script>
        
        function handleFormSubmit(response) {
            // input
            const title = document.getElementById('title').value
            const url = response.attachments[0].url
            
            //
            document.getElementById('title-hide').value = title
            document.getElementById('url-hide').value = url

            const form = document.getElementById('form').submit()
        }

        async function post(formData) {
            try {
                const res = await fetch(`<?= $_ENV['WEBHOOK_URL'] ?>`, {
                method: 'POST',
                body: formData
            })
            const data = await res.json()
            handleFormSubmit(data)
            } catch (error) {
                console.log(error);
            }
        }

        document.getElementById('btn').addEventListener('click', function (e) {
            const file = document.getElementById('file').files[0]
            const formData = new FormData()
            formData.append('file[0]', file)

            post(formData)
        })
    </script>
</body>
</html>