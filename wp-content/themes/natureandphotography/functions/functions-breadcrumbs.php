<?php
function custom_breadcrumbs()
{
    $separator = '&gt;';
    $breadcrums_id = 'breadcrumbs';
    $breadcrums_class = 'breadcrumbs';
    $home_title = 'Homepage';
    $class = '';
    $custom_taxonomy = 'product_cat';

    global $post, $wp_query;
    if (!is_front_page()) {
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
        if (is_archive() && !is_tax() && !is_category()) {
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title(null,
                    true) . '</strong></li>';
        } else {
            if (is_archive() && is_tax() && !is_category()) {
                $post_type = get_post_type();
                if ($post_type != 'post') {
                    $post_type_object = get_post_type_object($post_type);
                    $post_type_archive = get_post_type_archive_link($post_type);
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                    echo '<li class="separator"> ' . $separator . ' </li>';
                }
                $custom_tax_name = get_queried_object()->name;
                echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
            } else {
                if (is_single()) {
                    $post_type = get_post_type();
                    if ($post_type === 'person') {
                        echo '<li><a href="' . get_the_permalink(get_page_by_title('Sealy People')->ID) . '">Sealy People</a></li>';
                        echo '<li class="separator"> ' . $separator . ' </li>';
                        echo '<li><a href="' . get_the_permalink(get_page_by_title('Sealy Family')->ID) . '">Sealy Family</a></li>';
                        echo '</ul>';
                        return;
                    }
                    if ($post_type === 'news') {
                        echo '<li><a href="' . get_home_url() . '">Latest News</a></li>';
                        echo '<li class="separator"> ' . $separator . ' </li>';
                        echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                        echo '</ul>';
                        return;
                    }
                    if ($post_type != 'post') {
                        $post_type_object = get_post_type_object($post_type);
                        $post_type_archive = get_post_type_archive_link($post_type);
                        echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                        echo '<li class="separator"> ' . $separator . ' </li>';
                    }
                    $category = get_the_category();
                    $category_reference = array_values($category);
                    $last_category = end($category_reference);
                    $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                    $cat_parents = explode(',', $get_cat_parents);
                    $cat_display = '';
                    foreach ($cat_parents as $parents) {
                        $cat_display .= '<li class="item-cat">' . $parents . '</li>';
                        $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                    }
                    $taxonomy_exists = taxonomy_exists($custom_taxonomy);
                    if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                        $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                        $cat_id = $taxonomy_terms[0]->term_id;
                        $cat_nicename = $taxonomy_terms[0]->slug;
                        $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                        $cat_name = $taxonomy_terms[0]->name;
                    }
                    if (!empty($last_category)) {
                        echo $cat_display;
                        echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                    } else {
                        if (!empty($cat_id)) {
                            echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                            echo '<li class="separator"> ' . $separator . ' </li>';
                            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                        } else {
                            echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                        }
                    }
                } else {
                    if (is_category()) {
                        $category = get_the_category();
                        $category_reference = '';
                        $category_reference = array_values($category);
                        $last_category = end($category_reference);
                        $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                        $cat_parents = explode(',', $get_cat_parents);
                        $cat_display = '';
                        $count = count($cat_parents);
                        $i = 0;
                        foreach ($cat_parents as $parents) {
                            $i++;
                            if ($i < $count) {
                                $cat_display .= '<li class="item-current item-cat">' . $parents . '</li>';
                            } else {
                                $cat_display .= '<li class="item-cat">' . $parents . '</li>';
                            }
                            if ($i < $count) {
                                $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                            }
                        }
                        echo $cat_display;
                    } else {
                        if (is_page()) {
                            if ($post->post_parent) {
                                $anc = get_post_ancestors($post->ID);
                                $anc = array_reverse($anc);
                                foreach ($anc as $ancestor) {
                                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                                }
                                echo $parents;
                                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';
                            } else {
                                echo '<li class="item-current item-' . $post->ID . '">' . get_the_title() . '</li>';
                            }
                        } else {
                            if (is_tag()) {
                                $term_id = get_query_var('tag_id');
                                $taxonomy = 'post_tag';
                                $args = 'include=' . $term_id;
                                $terms = get_terms($taxonomy, $args);
                                echo '<li class="item-current item-tag-' . $terms->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';
                            } elseif (is_day()) {
                                echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
                                echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
                                echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link(get_the_time('Y'),
                                        get_the_time('m')) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
                                echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
                                echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
                            } else {
                                if (is_month()) {
                                    echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link(get_the_time('Y')) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
                                    echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
                                    echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
                                } else {
                                    if (is_year()) {
                                        echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
                                    } else {
                                        if (is_author()) {
                                            global $author;
                                            $userdata = get_userdata($author);
                                            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
                                        } else {
                                            if (get_query_var('paged')) {
                                                echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">' . __('Page') . ' ' . get_query_var('paged') . '</strong></li>';
                                            } else {
                                                if (is_search()) {
                                                    echo '<li class="item-current item-current-' . get_search_query() . '">Search results for: ' . get_search_query() . '</li>';
                                                } elseif (is_404()) {
                                                    echo '<li>' . 'Error 404' . '</li>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        echo '</ul>';
    }
}
?>