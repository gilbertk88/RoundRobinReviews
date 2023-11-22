<?php

$wp_q_list = get_posts( [
    'post_type'     => 'round_rebon_company',
] );

$wp_q_list_count = count( $wp_q_list );

?>

<h2 class="screen-reader-text">Filter posts list</h2>
<ul class="subsubsub">
	<li class="all">
        <a href="edit.php?;post_type=post" class="current" aria-current="page">All <span class="count">( <?php echo $wp_q_list_count; ?> )</span></a>
    </li>
</ul>

</div>

<h2 class="screen-reader-text">Posts list</h2>

<table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
        <tr>
        <th scope="col" id="author" class="manage-column column-author">
            Company Name
        </th>
        <th scope="col" id="author" class="manage-column column-author">
            Author
        </th>
        <th scope="col" id="author" class="manage-column column-author">
            Number of Locations
        </th>
        <th scope="col" id="date" class="manage-column column-date sortable asc">
            Manage
        </th>	
    </tr>
    </thead>
    <tbody id="the-list">
    
        <?php 


foreach( $wp_q_list as $key => $value ) {

    $value_post_author  = get_user_by( 'ID' , $value->post_author ) ;
    $value_DATA         = get_post_meta( $value->ID ) ;
    $company_name       = $value->post_title ;
    $author_name        = $value_post_author->user_login ;
    $number_of_locations= count( $value_DATA ) ;
    $manager_link       =  admin_url()."admin.php?page=round-robin-new&round-robin-company-id=".$value->ID ;

    include dirname(__FILE__).'/single_company_line.php' ;

}

        ?>
	</tbody>
</table>
</form>