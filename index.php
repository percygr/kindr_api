<!DOCTYPE html>
<html>

<head>
    <title>My Past Projects</title>
    <!-- Link to Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->

    <style>
        .custom-modal {
            max-width: 90%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4 mb-4">My Past Projects</h1>
        <div class="row">
            <?php
            // Sample projects data with multiple images for each project
            $projects = array(
                array(
                    'images' => array('images/solartracker.jpg', 'images/esp32radio.jpg', 'images/solartracker.jpg'),
                    'description' => 'Project 1: Lorem ipsum dolor sit amet<br>consectetur adipiscing elit.',
                ),
                array(
                    'images' => array('images/esp32radio.jpg', 'images/solartracker.jpg', 'images/esp32radio.jpg'),
                    'description' => 'Project 2: Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                ),
                // Add more projects here...
            );

            foreach ($projects as $index => $project) {
                echo '<div class="col-md-6 mb-4">';
                echo '<div class="card">';
                echo '<img class="card-img-top" src="' . $project['images'][0] . '" alt="Project Image">';
                echo '<div class="card-body">';
                echo '<p class="card-text">' . $project['description'] . '</p>';
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal' . $index . '">View Images</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Modal for each project
                echo '<div class="modal fade" id="projectModal' . $index . '" tabindex="-1" aria-labelledby="projectModalLabel' . $index . '" aria-hidden="true">';
                echo '<div class="modal-dialog modal-dialog-centered custom-modal">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="projectModalLabel' . $index . '">Project Images</h5>';
                echo '<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">Close</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<div id="carouselExample' . $index . '" class="carousel slide" data-bs-ride="carousel">';
                echo '<div class="carousel-inner">';
                $active = true;
                foreach ($project['images'] as $image) {
                    echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                    echo '<img src="' . $image . '" class="d-block w-100" alt="Project Image">';
                    echo '</div>';
                    $active = false;
                }
                echo '</div>';
                echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample' . $index . '" data-bs-slide="prev">';
                echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Previous</span>';
                echo '</button>';
                echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselExample' . $index . '" data-bs-slide="next">';
                echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Next</span>';
                echo '</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>


    <!-- Link to Bootstrap JS (if needed) -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var openModalBtns = document.querySelectorAll('.btn-primary[data-bs-toggle="modal"]');
            openModalBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var targetModal = btn.getAttribute('data-bs-target');
                    var myModal = new bootstrap.Modal(document.querySelector(targetModal));
                    myModal.show();
                });
            });

            var carouselControls = document.querySelectorAll('.carousel-control-prev, .carousel-control-next');
            carouselControls.forEach(function(control) {
                control.addEventListener('click', function() {
                    var carouselId = control.getAttribute('data-bs-target');
                    var carouselElement = document.querySelector(carouselId);
                    var carousel = new bootstrap.Carousel(carouselElement);
                    if (control.classList.contains('carousel-control-prev')) {
                        carousel.prev();
                    } else if (control.classList.contains('carousel-control-next')) {
                        carousel.next();
                    }
                });
            });
        });
    </script>
</body>

</html>