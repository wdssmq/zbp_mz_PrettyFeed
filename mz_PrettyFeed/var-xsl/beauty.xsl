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
            <p class="identity">
              <svg viewBox="0 0 24 24" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="6.5" cy="17.5" r="2.5" fill="currentColor"/>
                <path d="M4 4.5C12.6 4.5 19.5 11.4 19.5 20" fill="none" stroke="currentColor" stroke-width="3"/>
                <path d="M4 10C9.6 10 14 14.4 14 20" fill="none" stroke="currentColor" stroke-width="3"/>
              </svg>
              <a href="{channel/link}">
                <xsl:value-of select="channel/title"/>
              </a>
            </p>
            <p class="description">
              <xsl:value-of select="channel/description"/>
            </p>
            <p class="notice">这是本站的 RSS 订阅源。将当前地址添加到你常用的阅读器，即可在没有推荐算法干扰的情况下接收更新。</p>
            <div class="subscribe-links">
              <a class="feedly-link" title="Feedly" href="#">Feedly</a>
              <a class="inoreader-link" title="Inoreader" href="#">Inoreader</a>
              <a class="follow-link" title="Follow" href="#">Follow</a>
            </div>
          </header>
          <section class="items">
            <xsl:for-each select="channel/item">
              <article>
                <details>
                  <summary>
                    <div class="item-heading">
                      <h2>
                        <xsl:value-of select="title"/>
                      </h2>
                    </div>
                    <time>
                      <xsl:value-of select="pubDate"/>
                    </time>
                  </summary>
                  <div class="summary">
                    <xsl:value-of select="description" disable-output-escaping="yes"/>
                  </div>
                  <a class="read-more" href="{link}">阅读全文</a>
                </details>
              </article>
            </xsl:for-each>
          </section>
          <footer>RSS Feed</footer>
        </main>
        <script><![CDATA[(function () { const feedUrl = window.location.href; const encodedUrl = encodeURIComponent(feedUrl); document.querySelector('.feedly-link').href = 'https://feedly.com/i/subscription/feed/' + encodedUrl; document.querySelector('.inoreader-link').href = 'https://www.inoreader.com/feed/' + encodedUrl; document.querySelector('.follow-link').href = 'follow://add?url=' + encodedUrl; }());]]></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
