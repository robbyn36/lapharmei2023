<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-id="AI000010">Open Modal</button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalData">Loading...</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Button click event
    $('.btn-primary').click(function() {
      var id = $(this).data('id'); // Get the data-id attribute value

      // Send an AJAX request to fetch data
      $.ajax({
        url: 'fetch.php', // Update with your server-side PHP script URL
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
          // Update the modal content with the fetched data
          $('#modalData').html(response);
        },
        error: function(xhr, status, error) {
          console.log(error); // Handle error, if any
        }
      });
    });
  });
</script>
