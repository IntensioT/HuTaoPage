    <?php
        
            // Get the name of the text file
            $filename = $argv[1];

            // Read the contents of the text file into a string
            $contents = file_get_contents($filename);

            // Convert the contents to an array of lines and sort them
            $lines = explode("\n", $contents);
            sort($lines);

            // Join the sorted lines back into a string and write it back to the file
            $sortedContents = implode("\n", $lines);
            file_put_contents($filename, $sortedContents);

            echo "The file $filename has been sorted alphabetically.", "\n";
        
    ?>
