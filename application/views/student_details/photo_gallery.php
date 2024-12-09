<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<style>
    .gallery-container {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 40px 0;
    }

    .gallery-header {
        text-align: center;
        margin-bottom: 50px;
        padding: 20px;
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .upload-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        margin-bottom: 40px;
    }

    .upload-card:hover {
        transform: translateY(-5px);
    }

    .photo-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        margin-bottom: 30px;
        height: 100%;
    }

    .photo-card:hover {
        transform: translateY(-10px);
    }

    .photo-container {
        position: relative;
        padding-top: 75%; /* 4:3 Aspect Ratio */
        overflow: hidden;
    }

    .photo-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .photo-container:hover img {
        transform: scale(1.05);
    }

    .photo-info {
        padding: 20px;
    }

    .btn-group {
        display: flex;
        gap: 10px;
    }

    .btn-custom {
        flex: 1;
        padding: 8px 15px;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .btn-download {
        background: #28a745;
        color: white;
        border: none;
    }

    .btn-download:hover {
        background: #218838;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
    }

    .btn-delete:hover {
        background: #c82333;
        color: white;
        transform: translateY(-2px);
    }

    .upload-form {
        display: flex;
        gap: 15px;
        padding: 20px;
    }

    .file-input-container {
        flex: 1;
    }

    .custom-file-input {
        border-radius: 20px;
        padding: 10px;
        border: 2px dashed #dee2e6;
        transition: all 0.3s ease;
    }

    .custom-file-input:hover {
        border-color: #6c757d;
    }

    .alert {
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .back-btn {
        margin-top: 30px;
        border-radius: 20px;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        transform: translateX(-5px);
    }

    .empty-gallery {
        text-align: center;
        padding: 50px;
        color: #6c757d;
    }
</style>

<div class="gallery-container">
    <div class="container">
        <div class="gallery-header" data-aos="fade-down">
            <h2>Photo Gallery - <?php echo $student->FIRST_NM; ?></h2>
        </div>
        
        <!-- Upload Form -->
        <div class="upload-card" data-aos="fade-up">
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            
            <?php echo form_open_multipart('Student_details/upload_photo/'.$student->STUDENTID, ['class' => 'upload-form']); ?>
                <div class="file-input-container">
                    <input type="file" name="photo" class="form-control custom-file-input" required>
                </div>
                <button type="submit" class="btn btn-primary btn-custom">Upload Photo</button>
            <?php echo form_close(); ?>
        </div>
        
        <!-- Photo Gallery -->
        <div class="row">
            <?php if(!empty($photos)): ?>
                <?php foreach($photos as $index => $photo): ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                        <div class="photo-card">
                            <div class="photo-container">
                                <img src="<?php echo base_url($photo->photo_path); ?>" alt="Student Photo">
                            </div>
                            <div class="photo-info">
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php echo date('d M Y', strtotime($photo->uploaded_at)); ?>
                                </p>
                                <div class="btn-group">
                                    <a href="<?php echo base_url($photo->photo_path); ?>" 
                                       class="btn btn-custom btn-download" 
                                       download>
                                       <i class="fas fa-download"></i> Download
                                    </a>
                                    <a href="<?php echo base_url('Student_details/delete_photo/'.$photo->id.'/'.$student->STUDENTID); ?>" 
                                       class="btn btn-custom btn-delete" 
                                       onclick="return confirm('Are you sure you want to delete this photo?')">
                                       <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-gallery" data-aos="fade-up">
                        <i class="fas fa-images fa-3x mb-3"></i>
                        <h4>No photos uploaded yet</h4>
                        <p class="text-muted">Start adding photos to create a gallery</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center">
            <a href="<?php echo base_url('Student_details/show_student_details/'.$student->STUDENTID); ?>" 
               class="btn btn-secondary back-btn" data-aos="fade-up">
               <i class="fas fa-arrow-left"></i> Back to Student Details
            </a>
        </div>
    </div>
</div>

<!-- Initialize AOS -->
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
</script> 