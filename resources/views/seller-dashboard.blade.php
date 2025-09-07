<x-app-seller-layout>
  <style>
    .progress-bar {
    background-color: #007bff;
    font-size: 14px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
}
.animated-btn {
    position: relative;
    display: inline-flex;  /* Ensures proper layout */
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    border: 2px solid transparent;  /* Initially set border to transparent */
    color: #fff;  /* Text color */
    background-color: #f44336;  /* Red background color */
    overflow: hidden;  /* Ensures that the wave stays inside the button */
    transition: all 0.3s ease-in-out;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.animated-btn i {
    margin-right: 8px;  /* Spacing between the icon and the text */
    transition: transform 0.3s ease-in-out;
}

/* Hover Effect */
.animated-btn:hover {
    transform: scale(1.05); 
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); 
    border: 1px solid #F44336; 

}

/* Red wave animation */
.animated-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50px;
    background: linear-gradient(45deg, #ff6f61, #f44336, #ff6f61, #f44336);
    background-size: 400% 400%;
    animation: wave-animation 2s linear infinite;  /* Wave animation */
    z-index: -1;  /* Ensure wave is under the text */
}

/* Icon animation */
.animated-btn i {
    animation: arrowMove 1s ease-in-out infinite;
}

/* Pulsating Effect */
@keyframes pulse {
    0%, 100% {
        box-shadow: 0 0 10px rgba(255, 0, 0, 0.4); /* Red glow */
    }
    50% {
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.6); /* More intense red glow */
    }
}

/* Arrow Up/Down Animation */
@keyframes arrowMove {
    0%, 100% {
        transform: translateY(0);  /* Original position */
    }
    50% {
        transform: translateY(-5px);  /* Move arrow up */
    }
}

/* Wave animation effect */
@keyframes wave-animation {
    0% {
        background-position: 100% 50%;  /* Start with wave at the right */
    }
    50% {
        background-position: 0% 50%;  /* Move wave to the left */
    }
    100% {
        background-position: 100% 50%;  /* Wave moves back to the right */
    }
}


  </style>
    <div class="main main-app p-3 p-lg-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <div>
            <h4 class="main-title mb-0">Welcome to Seller Dashboard</h4>
          </div>
  
          <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
            <button type="button" class="btn btn-white btn-icon"><i class="ri-share-line fs-18 lh-1"></i></button>
            <button type="button" class="btn btn-white btn-icon"><i class="ri-printer-line fs-18 lh-1"></i></button>
            <button type="button" class="btn btn-primary d-flex align-items-center gap-2"><i class="ri-bar-chart-2-line fs-18 lh-1"></i>Generate<span class="d-none d-sm-inline"> Report</span></button>
          </div>
        </div>
  
        <div class="row g-3">
            <!-- Add the Current Plan Details Card -->
            <div class="col-12">
              <div class="card card-one shadow-sm border-0 rounded-3">
                  <div class="card-header text-white p-3 rounded-3">
                      <h6 class="card-title m-0">Current Plan Details</h6>
                  </div>
                  <div class="card-body p-4">
                      <!-- Plan Cost & Expiration Date -->
                      <div class="d-flex justify-content-between align-items-center mb-4">
                          <div>
                            @php
                            $totalDays = $currentpackage->valid_days??'0'; 
                            $startDate = Carbon\Carbon::parse($currentpackage->expire_date?? now())->subDays($currentpackage->valid_days??'1');
                            $currentDate = now(); 
                            
                            $usedDays = $startDate->diffInDays($currentDate) + 1; 
                            $usedDays = min($usedDays, $totalDays); 
                            $balanceDays = max(0, $totalDays - $usedDays);
                            $progress = round(($usedDays==0?1:$usedDays / $totalDays) * 100, 2);
                        @endphp
                              <label class="d-block text-muted fs-sm mb-1">Plan Cost</label>
                              <span class="d-block fs-5 fw-bold text-dark">
                                  Rs. {{ $currentpackage->price ?? '00.00' }}
                              </span>
                          </div>
                          <div>
                              <label class="d-block text-muted fs-sm mb-1">Expiration Date</label>
                              <span class="d-block fs-5 fw-bold text-dark">
                                  {{ $currentpackage->expire_date ?? '--, --, ----' }}
                              </span>
                          </div>
                          
          
                      <!-- Day Progress -->
          
                      <!-- Circular Progress with Gradient -->
                      <div id="progress-circle" class="progress-circle mb-4" 
                      style="position: relative; width: 120px; height: 120px; border-radius: 50%; background: conic-gradient(#4caf50 0%, #e0e0e0 0% 100%); transition: all 0.3s ease;">
                      <div id="progress-text" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 20px; font-weight: 600; color: #333;">
                          0%
                      </div>
                  </div>
                  
                          <span data-bs-toggle="tooltip" title="Total days of your current plan">Total Days: {{ $totalDays }}</span>
                          <span data-bs-toggle="tooltip" title="The remaining days left in your plan">Balance Days: <span id="balance-days">{{ $balanceDays }}</span></span>
                          <div class="d-flex justify-content-between">
                            <!-- My Plans Button -->
                            <a href="{{ route('my.packages') }}" class="btn btn-outline-success d-flex align-items-center gap-2 rounded-pill px-4 py-2 shadow-sm hover-effect">
                              <i class="ri-star-half-fill"></i> My Packages
                            </a>
                        
                            <a href="{{ route('choose.package') }}" class="btn btn-success d-flex align-items-center gap-2 rounded-pill px-4 py-2 shadow-sm hover-effect {{ isset($currentpackage) ? '' : 'animated-btn' }}">
                                <i class="ri-arrow-up-line fs-18 lh-1"></i> Upgrade Plan
                            </a>
                            
                        </div>
                        </div>
                  </div>
              </div>
          </div>
          
          <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        
            const totalDays = {{ $totalDays }};
            const startDate = new Date("{{ $startDate->format('Y-m-d') }}").getTime();  
        
            function updateBalanceDays() {
    const currentDate = new Date().getTime(); 
    const elapsedTime = currentDate - startDate; 
    const usedDays = Math.floor(elapsedTime / (1000 * 3600 * 24)) + 1; 
    
    if (!totalDays || totalDays <= 0) {
        console.error("Invalid totalDays value:", totalDays);
        
        document.getElementById('progress-circle').style.background = `conic-gradient(#f44336 100%, #e0e0e0 100% 100%)`;
        document.getElementById('progress-text').textContent = "Invalid";
        document.getElementById('balance-days').textContent = "N/A";
        return;
    }

    const balanceDays = Math.max(0, totalDays - usedDays); 

    document.getElementById('balance-days').textContent = balanceDays;

    const progress = Math.round((usedDays / totalDays) * 100);
    console.log("Progress:", progress);

    const color = (progress === 0 || progress === 100) ? '#f44336' : '#4caf50';
    
    document.getElementById('progress-circle').style.background = `conic-gradient(${color} ${progress}%, #e0e0e0 ${progress}% 100%)`;
    document.getElementById('progress-text').textContent = `${progress}%`;
    
    if (balanceDays === 0) {
        clearInterval(interval);
    }
}




        
            // Update every minute
            const interval = setInterval(updateBalanceDays, 60000);
        
            // Initial call to set values
            updateBalanceDays();
        </script>
          
          
        </div><!-- row -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Jayam Web Soluions</a></span>
          </div><!-- main-footer -->
      </div>
</x-app-seller-layout>
