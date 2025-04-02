<?php 
$subscriber = new subscribers($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subscriber->email = $_POST['email'];
    $subscriber->verified_token = "verified"; // Generate a random verification token
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $subscriber->created_at = date("Y-m-d H:i:s", time());
    $subscriber->updated_at = date("Y-m-d H:i:s", time());

    if ($subscriber->create()) {
        $message = "You have successfully subscribed to the newsletter!";
    } else {
        $message = "There was an error while subscribing.";
    }
   
}

 ?>


<form class="container-fluid subscribe py-5"  method="POST">
        <div class="container text-center py-5">
            <div class="mx-auto text-center" style="max-width: 900px;">
                <h5 class="subscribe-title px-3">Subscribe</h5>
                <h1 class="text-white mb-4">Our Newsletter</h1>
                <p class="text-white mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti eum cum repellat a laborum quasi.
                </p>
                <div class="position-relative mx-auto">
                    <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" id="email" name="email" placeholder="Your email">
                    <button type="submit" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2"  >Subscribe</button>
                </div>
            </div>
             <label for="mc-email" class="subscribe-message"></label>
        </div>
 </form>


