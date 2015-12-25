	<url>
			<loc><?=$url?></loc>
			<lastmod><?=$date?></lastmod>
<?php if (isset($change) && empty($change) === false): ?>
			<changefreq><?=$change?></changefreq>
<?php endif ?>
<?php if (isset($priority) && empty($priority) === false): ?>
			<priority><?=$priority?></priority>
<?php endif ?>
	</url>