<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" encoding="UTF-8" indent="yes"/>
  <xsl:template match="/rss">
    <html lang="zh-CN">
      <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>
          <xsl:value-of select="channel/title"/>
 - RSS</title>
        <style>/* MZ_PRETTYFEED_CSS */</style>
      </head>
      <body>
        <main>
          <header>
            <p class="eyebrow">RSS Feed</p>
            <h1>
              <xsl:value-of select="channel/title"/>
            </h1>
            <p class="description">
              <xsl:value-of select="channel/description"/>
            </p>
          </header>
          <div class="subscribe">
            <div>这是一个 RSS 订阅源。可使用以下服务订阅：</div>
            <div class="subscribe-links">
              <a class="feedly-link" title="Feedly" href="#">Feedly</a>
              <a class="inoreader-link" title="Inoreader" href="#">Inoreader</a>
              <a class="follow-link" title="Follow" href="#">Follow</a>
            </div>
          </div>
          <xsl:for-each select="channel/item">
            <article>
              <h2>
                <a href="{link}">
                  <xsl:value-of select="title"/>
                </a>
              </h2>
              <time>
                <xsl:value-of select="pubDate"/>
              </time>
              <div class="summary">
                <xsl:value-of select="description" disable-output-escaping="yes"/>
              </div>
            </article>
          </xsl:for-each>
          <footer>由 RSS 提供更新</footer>
        </main>
        <script><![CDATA[(function () { const feedUrl = window.location.href; const encodedUrl = encodeURIComponent(feedUrl); document.querySelector('.feedly-link').href = 'https://feedly.com/i/subscription/feed/' + encodedUrl; document.querySelector('.inoreader-link').href = 'https://www.inoreader.com/feed/' + encodedUrl; document.querySelector('.follow-link').href = 'follow://add?url=' + encodedUrl; }());]]></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
