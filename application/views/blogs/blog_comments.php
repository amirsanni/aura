<?php defined('BASEPATH') OR exit("Access Denied") ?>

<?php if($comments): ?>
<?php foreach($comments as $get): ?>
<li class="clearfix">
    <figure class="animate-effect">
        <img src="<?=base_url()?>public/alphabets/<?=strtoupper(substr($get->username, 0, 1))?>.gif" alt="<?=$get->username?>">
    </figure>
    <div class="user-comment animate-effect">
        <h5> <?=$get->username?> </h5>
        <ul class="comment-status">
            <li class="line">
                <?= timespan(strtotime($get->date_added), time(), 1) ?> ago
            </li>
            <li>
                <a href="#"> Reply</a>
            </li>
        </ul>
        <p><?=$get->comment_body?></p>
    </div>
    
    <?php $comment_replies = $this->blogmodel->getCommentReplies($get->id) ?>
    <?php if($comment_replies):?>
    <?php foreach($comment_replies as $reply): ?>
    <li class="left-subspacer clearfix">
        <figure class="animate-effect">
            <img src="<?=base_url()?>public/alphabets/<?=strtoupper(substr($reply->username, 0, 1))?>.gif" alt="<?=$reply->username?>">
        </figure>
        <div class="user-comment animate-effect">
            <h5> <?=$reply->username?> </h5>
            <ul class="comment-status">
                <li class="line"><?=timespan(strtotime($reply->date_added), time(), 1)?> ago</li>
                <li>
                    <a href="#"> Reply</a>
                </li>
            </ul>
            <p><?=$reply->reply_body?></p>
        </div>
    </li>
    <?php endforeach; ?>
    <?php endif; ?>
</li>
<?php endforeach; ?>
<?php endif; ?>