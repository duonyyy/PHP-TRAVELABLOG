<div class="container-fluid px-4">
    <h1 class="mt-4">Send Mail to All Subscribers</h1>
   
    <div id="msg">
        <!-- Show message -->
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="post" action="index.php?page=subscribers_add">
                <div class="mb-3">
                    <label for="title" class="form-label">Subject</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="5" placeholder="Enter email content"></textarea>
                </div>
                <button type="button" onclick="sendMail()" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
