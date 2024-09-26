<style>

   

    /* Styling for the container */

    .step-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .step {
        display: flex;
        align-items: center;
        position: relative;
        color: #6c757d; /* Default gray color for non-active steps */
        flex: 1;
        text-align: center;
        padding: 0 10px; /* Add some padding between the steps */
    }

    .step-number {
        background-color: #6c757d; /* Default gray */
        color: white;
        border-radius: 50%;
        padding: 10px 15px;
        font-weight: bold;
        margin-right: 10px;
        display: inline-block;
        z-index: 1;
    }

    .step.active .step-number {
        background-color: #007bff; /* Blue color for the active step */
    }

    .step-title {
        font-size: 1rem;
        color: black;
        z-index: 1;
        font-weight: 500;
    } 
</style>

<div class="step-container">
    <div class="step {{ Route::currentRouteName() == 'create.merchants.kfc' ? 'active' : '' }}">
        <a href="{{ route('create.merchants.kfc') }}">
            <div class="step-number">1</div>
            <div class="step-title">KYC</div>
        </a>
    </div>

    <div class="step {{ Route::currentRouteName() == 'create.merchants.documents' ? 'active' : '' }}">
        <a href="{{ route('create.merchants.documents') }}">
           <div class="step-number">2</div>
           <div class="step-title">Documents</div>
        </a>
    </div>

    <div class="step {{ Route::currentRouteName() == 'create.merchants.sales' ? 'active' : '' }}">
        <a href="{{ route('create.merchants.sales') }}">
           <div class="step-number">3</div>
           <div class="step-title">Sales</div>
        </a>
    </div>

    <div class="step {{ Route::currentRouteName() == 'create.merchants.services.form' ? 'active' : '' }}">
        <a href="{{ route('create.merchants.services.form') }}">
           <div class="step-number">4</div>
           <div class="step-title">Services</div>
        </a>
    </div>
</div>
