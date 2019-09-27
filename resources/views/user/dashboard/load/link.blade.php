                      <?php 
                      if($links->count()) {
                        foreach($links as $link) {
                      ?>
                          <li class="link-list" id="link-url-update-{{$link->id}}">
                            <div class="div-table mb-4">
                              <div class="div-cell">
                                <span class="handle">
                                  <i class="fas fa-bars"></i>
                                </span>
                              </div>

                              <div class="div-cell">
                                <div class="col-md-12 col-12 pr-0 pl-0">
                                  <div class="input-stack">
                                    <input type="hidden" name="idlink[]" value="{{$link->id}}">
                                    <input class="delete-link" type="hidden" name="deletelink[]" value="">
                                    <input type="text" name="title[]" value="{{$link->title}}" id="title-{{$link->id}}-view-update" placeholder="Title" class="form-control focuslink-update">
                                    <input type="text" name="url[]" value="{{$link->link}}" placeholder="http://url..." class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-12 col-12 pr-0 pl-0">
                                  <select name="linkpixel[]" id="linkpixel-{{$link->id}}-update" class="form-control linkpixel">
                                  </select>
                                </div> 
                              </div>
                              
                              <div class="div-cell cell-btn deletelink-update">
                                <span>
                                  <i class="far fa-trash-alt"></i>
                                </span>
                              </div>
                            </div>
                          </li>
                          <script>
                            $("#linkpixel-1").html(dataView);
                            $("#linkpixel-{{$link->id}}-update").val('{{$link->pixel_id}}');
                            // loadPixel('{{$link->pixel_id}}','#linkpixel-{{$link->id}}-update');
                          </script>
                      <?php 
                        }
                      }
                      else {
                      ?>

                        <li class="link-list" id="link-url-1">
                          <div class="div-table mb-4">
                            <div class="div-cell">
                              <span class="handle">
                                <i class="fas fa-bars"></i>
                              </span>
                            </div>

                            <div class="div-cell">
                              <div class="col-md-12 col-12 pr-0 pl-0">
                                <div class="input-stack">
                                  <input type="hidden" name="idlink[]" value="new">
                                  <input type="hidden" name="deletelink[]" value="">
                                  <input type="text" name="title[]" value="" id="title-1-view" placeholder="Title" class="form-control focuslink">
                                  <input type="text" name="url[]" value="" placeholder="http://url..." class="form-control">
                                </div>
                              </div>
                              <div class="col-md-12 col-12 pr-0 pl-0">
                                <select name="linkpixel[]" id="linkpixel-1" class="form-control linkpixel">
                                </select>
                              </div> 
                            </div>
                            
                            <div class="div-cell cell-btn deletelink">
                              <span>
                                <i class="far fa-trash-alt"></i>
                              </span>
                            </div>

                          </div>
                        </li>
                        <script>
                          $("#linkpixel-1").html(dataView);
                          $("#linkpixel-1").val(0);
                          // loadPixel(0,'#linkpixel-1');
                        </script>
                      <?php } ?>
