    <form action="?e=<?php if($article){ echo $article->getId(); } ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="articleId" value="<?php if($article){ echo $article->getId(); }?>"/>

        <ul>

            <li>
                <label for="title">Article Title</label>
                <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php if($article){ echo $article->getTitle(); } ?>" />
            </li>

            <li>
                <label for="summary">Article Summary</label>
                <textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;"><?php if($article){ echo $article->getSummary(); } ?></textarea>
            </li>

            <li>
                <label for="content">Article Content</label>
                <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="height: 30em;"><?php if($article){ echo $article->getContent(); } ?></textarea>
            </li>
            <?php
            if($article && $article->getFileToUpload()){
                echo '<li>';
                echo '<label>Current Image</label>';
                echo '<div class="divimg"><p>' . $article->getFileToUpload() . '</p>';
                echo '<img align="middle" src="resources/images/' . $article->getFileToUpload() . '" style="height: 150px;"></div>';
                echo '</li>';
                echo '<li>';
                echo '<label for="contentImage">Change Image</label>';
                echo '<input type="file" name="fileToUpload" id="fileToUpload">';
                echo '</li>';

            } else {
                echo '<li>';
                echo '<label for="contentImage">Add Image</label>';
                echo '<input type="file" name="fileToUpload" id="fileToUpload">';
                echo '</li>';


            }

            ?>

            <li>
                <label for="publicationDate">Publication Date</label>
                <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php if($article) { echo $article->getPublicationDate() ? date( "Y-m-d", $article->getPublicationDate() ) : ""; }?>" />
            </li>



        </ul>


        <div class="buttons">
            <input type="submit" name="saveChanges" value="Save Changes" />
            <input type="submit" name="delete" value="Delete" />
            <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>

    </form>