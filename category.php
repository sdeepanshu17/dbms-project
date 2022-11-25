<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Discussion Forum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
        include('./navbar.php');
    ?>

    <section class="flex-col w-full justify-center mt-10">
        <?php
        echo '<form method="GET" action="/dbms-project/category.php/" class="flex justify-center items-center mb-8">   
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-5/12">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" name="cat" value="'.$_GET['cat'].'" hidden>
                <input type="text" name="q" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
            </div>
            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-[#4e53c8] rounded-lg border border-blue-700 hover:bg-[#3a3eac] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span class="sr-only">Search</span>
            </button>
        </form>';

        include("./conf.php");
        $searchQuery = $_GET['q'];
        $sql = "select * from message where category ='".$_GET['cat']."' AND approved = 1";
        if($searchQuery){
            echo "<h1 class='text-center text-2xl font-semibold'>Search results for: $searchQuery</h1>";
            $sql = "select * from message where category ='".$_GET['cat']."' AND approved = 1 AND  (heading LIKE '%$searchQuery%' OR body LIKE '%$searchQuery%')";
        }
        $res = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($res)) {
            echo
            '<div class="flex justify-center">
            <div class="rounded-xl border p-5 shadow-md bg-white m-3 w-4/5">
                <div class="flex w-full items-center justify-between border-b pb-3">
                    <div class="flex items-center space-x-3">
                        <div class="text-lg font-bold text-slate-700 cursor-pointer">@' . $result['rollno'] . '</div>
                        </div>
                        <div class="flex items-center space-x-8">
                        <button class="rounded-2xl border hover:bg-gray-200 bg-neutral-100 px-3 py-1 text-xs font-semibold">'.strtoupper($result['category']).'</button>
                        <div class="text-xs text-neutral-500">' . $result['timeSt'] . '</div>
                    </div>
                    </div>

                <div class="mt-4 mb-6">
                    <div class="mb-3 text-xl font-bold">' . $result['heading'] . '</div>
                    <div class="text-lg text-neutral-800">' . $result['body'] . '</div>
                </div>
            </div>
        </div>';
        }
        ?>
    </section>
</body>

</html>