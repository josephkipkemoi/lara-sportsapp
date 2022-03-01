<div class="row">
    <div class="col-sm-2">
        <div class="row p-4 form-group">
            <a href="#" class="form-control bg-black text-white">Soccer</a>
            <a href="#" class="form-control bg-black text-white mt-1">Ice Hockey</a>
            <a href="#" class="form-control bg-black text-white mt-1">Table Tennis</a>
            <a href="#" class="form-control bg-black text-white mt-1">Rugby</a>
            <a href="#" class="form-control bg-black text-white mt-1">Boxing</a>
            <a href="#" class="form-control bg-black text-white mt-1">MMA</a>
            <a href="#" class="form-control bg-black text-white mt-1">Basketball</a>
            <a href="#" class="form-control bg-black text-white mt-1">Aussie Rules</a>
            <a href="#" class="form-control bg-black text-white mt-1">Water Polo</a>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="p-4">
           <div class="d-sm-flex">    
                <a href="#" class="nav-link">Highlights</a>
                <a href="#" class="nav-link">Upcoming</a>
                <a href="{{ url('/countries') }}" class="nav-link">Countries</a>
           </div>
           
           <div class="d-sm-flex justify-content-between">
                <div>
                    <button class="btn btn-dark btn-sm">Filters</button>
                </div>
                <div>
                    <button class="btn btn-dark btn-sm">Today</button>
                    <button class="btn btn-dark btn-sm">Highlights</button>
                    <button class="btn btn-dark btn-sm">1x2</button>
                </div>
           </div>
           
           <div class="row">
                <div class="col-6">
                    <div class="row">
                        <span>Teams</span>
                        <div class="row">
                            <small>England * Premier League</small>
                            <a href="nav-link">Burnley</a>
                            <a href="">Chelsea</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-4 d-flex justify-content-between">
                    <div class="row  align-items-center">
                        <span>1</span>
                        <div>
                            <button class="btn btn-dark btn-sm">1.85</button>
                        </div>
                    </div>
                    <div class="row  align-items-center">
                        <span>X</span>
                        <div>
                            <button class="btn btn-dark btn-sm">2.43</button>
                        </div>
                    </div>
                    <div class="row  align-items-center">
                         <span>2</span>
                         <small class="d-block">02/03, 5:34</small>
                        <div >                           
                            <button class="btn btn-dark btn-sm">2.50</button>
                            <small><a href="#" class="nav-link">+98 Markets</a></small>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="p-4">
            <h3>BETSLIP</h3>
            <span>Do you have a betslip code? Enter it here</span>
            <input type="text" placeholder="e.g. VgHFs" class="form-control bg-dark text-white"/>
            <button class="btn btn-warning">Load Betslip</button>
        </div>
    </div>

</div>