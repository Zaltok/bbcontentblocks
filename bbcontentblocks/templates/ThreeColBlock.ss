<div class="row">
    <% if $Title %>
        <div class="col-md-12 text-{$Alignment}">
            $Title
        </div>
    <% end_if %>
    <div class="col-md-4 feature text-center">
        <div class="icon underline longer-underline">
            <% if $IconLeft %><i class="icon-{$IconLeft}"></i><% end_if %>
        </div>
        <h5 class="feature-title">{$LeftBlock.Title}</h5>
        <p class="feature-desc">{$LeftBlock.Content}</p>
    </div>

    <div class="col-md-4 feature text-center">
        <div class="icon underline longer-underline">
            <% if $IconMiddle %><i class="icon-{$IconMiddle}"></i><% end_if %>
        </div>
        <h5 class="feature-title">{$MiddleBlock.Title}</h5>
        <p class="feature-desc">{$MiddleBlock.Content}</p>
    </div>

    <div class="col-md-4 feature text-center">
        <div class="icon underline longer-underline">
        <% if $IconRight %><i class="icon-{$IconRight}"></i><% end_if %>
        </div>
        <h5 class="feature-title">{$RightBlock.Title}</h5>
        <p class="feature-desc">{$RightBlock.Content}</p>
    </div>
</div>