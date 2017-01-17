<div class="row">
    <% if $SideBarContent %>
    <div class="col-md-4">
        <div class="section-header">
            <h3 class="section-title underline">$SideBarTitle</h3>
        </div>
        $SideBarContent
    </div>

    <div class="col-md-8">
        $Title
        $Form
    </div>
    <% else %>

    <div class="col-md-12">
        $Title
        $Form
    </div>
    <% end_if %>
</div>
