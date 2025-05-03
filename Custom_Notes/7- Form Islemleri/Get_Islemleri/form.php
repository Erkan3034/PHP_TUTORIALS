<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST İŞLEMLERİ</title>
</head>

<body>


    <table style="margin: auto; padding: 5px;">
        <form action="get.php" method="get">
            <!-- Formun action kısmı post.php dosyasına yönlendirilmeyi belirtir. Method kısmı ise hangi metodla gönderileceğini belirtir. -->
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold;">İletişim Formu</td>
            </tr>
            <tr>
                <td>İsim</td>
                <td><input type="text" name="isim"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td>Mesaj</td>
                <td><textarea name="mesaj"></textarea></td>
            </tr>

            <hr>

            <tr>
                <th>Diller</th>
                <th>Seçenekler</th>
            </tr>
            <tr>
                <td>PHP</td>
                <td><input type="checkbox" name="diller[]" value="php"></td>
            </tr>
            <tr>
                <td>JAVA</td>
                <td><input type="checkbox" name="diller[]" value="java"></td>
            </tr>
            <tr>
                <td>PYTHON</td>
                <td><input type="checkbox" name="diller[]" value="python"></td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Gönder">
                    <input type="reset" value="Sıfırla">
                </td>
            </tr>

            
        </form>
    </table>

</body>

=======
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST İŞLEMLERİ</title>
</head>

<body>


    <table style="margin: auto; padding: 5px;">
        <form action="get.php" method="get">
            <!-- Formun action kısmı post.php dosyasına yönlendirilmeyi belirtir. Method kısmı ise hangi metodla gönderileceğini belirtir. -->
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold;">İletişim Formu</td>
            </tr>
            <tr>
                <td>İsim</td>
                <td><input type="text" name="isim"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td>Mesaj</td>
                <td><textarea name="mesaj"></textarea></td>
            </tr>

            <hr>

            <tr>
                <th>Diller</th>
                <th>Seçenekler</th>
            </tr>
            <tr>
                <td>PHP</td>
                <td><input type="checkbox" name="diller[]" value="php"></td>
            </tr>
            <tr>
                <td>JAVA</td>
                <td><input type="checkbox" name="diller[]" value="java"></td>
            </tr>
            <tr>
                <td>PYTHON</td>
                <td><input type="checkbox" name="diller[]" value="python"></td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Gönder">
                    <input type="reset" value="Sıfırla">
                </td>
            </tr>

            
        </form>
    </table>

</body>

>>>>>>> 7f892c26be6e64f015de83da8fe4dec62a81f6a8
</html>