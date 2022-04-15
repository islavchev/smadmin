
                <div class="form-group mb-3 col-md-4"> 
                    <label for="phone">Телефон</label>
                    <input 
                        type="text"
                        class="form-control form-control-sm"
                        name="phone" id="phone"
                        value="{{$academic->phone}}" required>
                </div>
            <div class="form-group mb-3 col-md-4"> 
                <label for="email">Ел. поща</label>
                <input 
                    type="email"
                    class="form-control form-control-sm"
                    name="email" id="email"
                    value="{{$academic->email}}" required>
            </div>