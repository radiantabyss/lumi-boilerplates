<?php
function dmp($text, $text2 = null) {
    $pre = true;
    if ( php_sapi_name() == 'cli' ) {
        $pre = false;
    }

    if ( $pre ) {
        echo '<pre>';
    }

    if ( $text2 !== null ) {
        echo $text.': ';
        var_dump($text2);
    }
    else {
        var_dump($text);
    }

    if ( $pre ) {
        echo '</pre>';
    }
    else {
        echo "\n";
    }
}

function ddmp($text) {
    dmp($text);die();
}

function delete_recursive($directory) {
    foreach(glob("{$directory}/*") as $file) {
        if ( is_dir($file) ) {
            delete_recursive($file);
        }
        else {
            @unlink($file);
        }
    }

    if ( !glob("{$directory}/*") ) {
        foreach( glob("{$directory}/.*") as $file ) {
            if ( $file == $directory.'/.' || $file == $directory.'/..' ) continue;

            @unlink($file);
        }
    }

    @rmdir($directory);
}

function increment_version($version) {
    list($major, $minor, $patch) = explode('.', $version);
    $patch++;
    return "$major.$minor.$patch";
}

function getFolders() {
    $folders = array_filter(glob('*'), 'is_dir');
    return $folders;
}

// Checkout the base branch
$main_branch = 'main';
shell_exec("git checkout $main_branch");

// Update the base branch
shell_exec("git pull origin $main_branch");

$folders = scandir(__DIR__);
$branches = [];
foreach ( $folders as $folder ) {
    if ( in_array($folder, ['.', '..', '.git']) || !is_dir($folder) ) {
        continue;
    }

    $branches[] = $folder;
}

foreach ($branches as $branch) {
    //check if branch exists
    if (shell_exec("git show-ref --verify --quiet refs/heads/$branch") === 0) {
        // Branch exists; get its latest version
        $current_version = trim(shell_exec("git tag -l '*' --sort=-v:refname | head -n 1"));

        if (!$current_version) {
            $current_version = 'v1.0.0';
        }

        $version = increment_version($current_version);
    }
    else {
        // Branch doesn't exist; create it with an initial version of v1.0.0
        $version = 'v1.0.0';
    }

    // Checkout to a new temporary branch
    shell_exec("git checkout -B temp_$branch $main_branch");

    // Remove all files except the folder of interest
    foreach ( $branches as $_branch ) {
        if ( $branch != $_branch ) {
            delete_recursive($branch);
        }
    }

    // Commit changes
    shell_exec("git add .");
    shell_exec("git commit -m '$version'");

    // Tag this commit
    shell_exec("git tag $version");

    // Force move the branch pointer to the current commit
    shell_exec("git branch -f $branch");
    shell_exec("git checkout $branch");

    //delete temp branch
    shell_exec("git branch -D temp_$branch");

    // Push changes to remote
    shell_exec("git push origin $branch --force");
    shell_exec("git push origin $version");

    // Checkout to the base branch before processing the next folder
    shell_exec("git checkout $main_branch");
}
?>
