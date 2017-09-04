<script type="application/text" id="buy-links">
    <ul>
        <% _.each(links, function(link) { %>
        <li><%= link.title %>: <a href="<%= link.link %>" target="__blank"><%= link.link %></a></li>
        <% }) %>
    </ul>
</script>