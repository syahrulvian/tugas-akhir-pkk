<?php header('Content-type: application/xml; charset="ISO-8859-1"', true);  ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc><?php echo site_url('') ?></loc>
        <lastmod>2025-11-05</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <?php
    $this->db->order_by('package_date', 'ASC');
    $getpkt = $this->db->get('tb_package');
    foreach ($getpkt->result() as $show) {

    ?>
        <url>
            <loc><?php echo strtolower(site_url($show->package_alias)) ?></loc>
            <lastmod><?php echo date("Y-m-d", strtotime($show->package_date)) ?></lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>
    <?php } ?>
    
    <?php
    $this->db->order_by('blog_date', 'ASC');
    $getblog = $this->db->get('tb_blog');
    foreach ($getblog->result() as $show) {

    ?>
        <url>
            <loc><?php echo strtolower(site_url($show->blog_alias)) ?></loc>
            <lastmod><?php echo date("Y-m-d", strtotime($show->blog_date)) ?></lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>
    <?php } ?>

</urlset>