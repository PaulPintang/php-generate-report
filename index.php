<?php 
    $db = mysqli_connect('localhost', 'root', '', 'report');
    $getStudent = mysqli_query($db, 'SELECT * FROM student');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <div class="flex h-screen items-center justify-center">
        <div class="bg-white rounded-lg p-6 shadow-sm" style="width: 500px">
            <div class="flex justify-between pb-5">
                <h1 class="font-medium text-gray-700">Student</h1>
                <div>
                    <a href="#addUser" data-toggle="modal">
                        <i class="fas fa-plus text-gray-400"></i>
                    </a>
                </div>
            </div>
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="">
                    <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Age
                    </th>
                    <th scope="col" class="relative px-3 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($row = mysqli_fetch_array($getStudent)) { ?>
                    <tr>
                        <td class="px-3 py-2 whitespace-nowrap">
                            <div class="ml-4">
                                <small><?php echo $row['name']?></small>
                            </div>
                        </td>

                        <td class="px-3 py-2 whitespace-nowrap">
                            <div class="ml-4">
                                <small><?php echo $row['age']?></small>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium" style="font-size: 13px">
                            <form action="generatepdf.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                <button type="submit" name="generate" class="text-indigo-600 hover:text-indigo-900 w-full transition-all">Generate</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
    </div>
</body>
</html>