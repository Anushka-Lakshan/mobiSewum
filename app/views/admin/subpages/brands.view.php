<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-5">
    <div class="dashboard-header">
        <h1 class="h2">Mobile Brands</h1>
        <p>Manage the mobile brands</p>
    </div>

    <a href="#" class="btn btn-primary mb-3" onclick="displayFormModal()">
        <i class="fas fa-plus"></i>
        Add New Brand
    </a>

    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Apple</td>
                    <td><img src="" alt=""></td>
                    <td>
                        <button class="btn-warning btn">Edit</button>
                        <button class="btn-danger btn">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Apple</td>
                    <td><img src="" alt=""></td>
                    <td>
                        <button class="btn-warning btn">Edit</button>
                        <button class="btn-danger btn">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="formModal" style="display: none;">
        <form id="categoryForm" enctype="multipart/form-data" >
            <input type="text" name="category_name" placeholder="Category Name">
            <input type="file" name="category_image" accept="image/*">
            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  // Function to display SweetAlert2 modal with form
  function displayFormModal() {
    Swal.fire({
      title: 'Add Category',
      html: document.getElementById('formModal').innerHTML,
      showCancelButton: true,
      showConfirmButton: false,
      allowOutsideClick: false,
      willOpen: () => {
        // Initialize form validation
        $('#categoryForm').validate({
          rules: {
            category_name: {
              required: true
            },
            category_image: {
              required: true,
              accept: "image/*"
            }
          },
          messages: {
            category_name: "Please enter category name",
            category_image: {
              required: "Please select an image",
              accept: "Please select a valid image file"
            }
          },
          submitHandler: function(form) {
            submitForm(form);
          }
        });
      }
    });
  }

  // Function to handle form submission
  function submitForm(form) {
    // Use FormData to handle file upload
    console.log(form);
    var formData = new FormData(form);
    $.ajax({
      type: "POST",
      url: "/admin/AJAX/add_category",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Category Added Successfully!',
          text: response.message
        });
      },
      error: function(xhr, status, error) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred while adding the category.'
        });
      }
    });
  }

  
</script>

</main>