<tr class="ewm_rr_tr_head" data-previous-data='<?php echo $manager_link; ?>' id="line_location_<?php echo $index_id ; ?>">

	<td class="ewm_rr_td_b" data-colname="Title" data-review-link-local-id="<?php echo $index_id ; ?>" id="review_location_detail_id_<?php echo $index_id ; ?>" >

       <?php echo $location ; ?>

    </td>

    <td class="ewm_rr_td_b" data-colname="Author">

        <a href="<?php echo $review_link; ?>" target="_blank" data-review-link-local-id="<?php echo $index_id ; ?>" id="review_link_detail_id_<?php echo $index_id ; ?>" class="review_link_detail_id"> <?php echo  substr( $review_link , 0,30 ) .'... '; ?> </a>

    </td>

    <td class="ewm_rr_td_b" data-colname="Author">

        <a href="<?php echo $review_link_mobile; ?>" target="_blank" data-line-edit-id = "<?php echo $line_id_key ; ?>" data-review-link-mobile-local-id="<?php echo $index_id ; ?>" id="review_link_mobile_detail_id_<?php echo $index_id ; ?>" class="review_link_detail_id" > <?php echo substr( $review_link_mobile , 0,30 ) .'... ' ; ?> </a>

    </td>

    <td class="ewm_rr_td_b" data-colname="Date">

        <span data-review-link-local-id="<?php echo $index_id ; ?>" data-line-edit-id = "<?php echo $line_id_key ; ?>"  data-previous-data=' <?php // echo $manager_link; ?>' class="edit_location_link" data-is-new-link="0" id="edit_link_details_<?php echo $index_id ; ?>" >
            Open
        </span>
        <span data-review-link-local-id="<?php echo $index_id ; ?>" data-line-edit-id = "<?php echo $line_id_key ; ?>"  data-previous-data='<?php // echo $manager_link; ?>' data-link-id="<?php echo $index_id ; ?>" id="delete_link_details_<?php echo $index_id ; ?>" class="delete_location_link dashicons dashicons-trash" ></span>

    </td>

</tr>
