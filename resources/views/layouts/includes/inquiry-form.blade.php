<section class="cta-sec position-relative z-index-9">
	<div class="container py-5 px-3 px-sm-5">
		<h5 data-aos="fade-down" class="sub-h text-center" style="color: #fff;">Lets Get Started</h5>
		<h2 data-aos="fade-down" class="main-h text-center" style="color: #fff;">Property Inquiry Form</h2>
		<div data-aos="fade-up" class="row mt-4">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form id="propertyForm" method="POST" class="cta-form">
				    @csrf
				    <div class="row g-3">
				        <div class="col-md-6">
				            <input type="text" title="Full Name" name="name" class="form-control" placeholder="Name" required>
				        </div>
				        <div class="col-md-6">
				            <input type="email" title="Email" name="email" class="form-control" placeholder="Email" required>
				        </div>
				        <div class="col-md-6">
				            <input type="tel" title="Phone" name="phone" class="form-control" placeholder="+92 -" required>
				        </div>
				        <div class="col-md-6">
				            @php
				                $offering = config('constants.offering');
				            @endphp
				            <select title="Property Type" class="form-select form-control" name="property_type" required>
				                <option value="">Select Property Type</option>
				                @foreach($offering as $type)
				                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
				                @endforeach
				            </select>
				        </div>
				        <div class="col-md-6">
				            <input type="text" title="Budget" name="budget" class="form-control" placeholder="Budget Range">
				        </div>
				        <div class="col-md-6">
				            <input type="text" title="Location" name="location" class="form-control" placeholder="Location Preferences">
				        </div>
				        <div class="col-12">
				            <textarea name="message" title="Message" class="form-control" rows="4" placeholder="Message"></textarea>
				        </div>
				        <div class="col-12 text-center">
				            <button type="submit" class="btn btn-custom px-4 py-2">SUBMIT NOW</button>
				            <div class="property-ajax-message mt-3"></div>
				        </div>

				    </div>
				</form>

			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</section>