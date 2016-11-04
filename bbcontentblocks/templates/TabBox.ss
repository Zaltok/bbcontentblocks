<% if $Tabs %>
    <!-- \\ Begin Tab side \\ -->
    <div class="Tabside">
        <ul>
            <% loop $Tabs %>
                <li><a href="javascript:;" class="tabLink <% if First %>activeLink<% end_if %>" id="cont-{$ID}">$TabTitle</a></li>
            <% end_loop %>
        </ul>
        <div class="clear"></div>
        <% loop $Tabs %>
            <div class="tabcontent <% if First %><% else %>hide<% end_if %>" id="cont-{$ID}-1">
            <div class="TabImage">
                <div class="img1">
                    <figure><img src="/images/about-img2.jpg" alt="image"></figure>
                </div>
                <div class="img2">
                    <figure><img src="../images/about-img1.jpg" alt="image"></figure>
                </div>
            </div>
            <div class="Description">
                <h3>$Title</h3>
                $Content
            </div>
        </div>
        <% end_loop %>

    </div>
<% end_if %>
