const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"products.index":{"uri":"products","methods":["GET","HEAD"]},"categories.index":{"uri":"categories","methods":["GET","HEAD"]},"categories.create":{"uri":"categories\/create","methods":["GET","HEAD"]},"categories.store":{"uri":"categories","methods":["POST"]},"categories.edit":{"uri":"categories\/{category}\/edit","methods":["GET","HEAD"],"parameters":["category"],"bindings":{"category":"id"}},"categories.update":{"uri":"categories\/{category}","methods":["PUT"],"parameters":["category"],"bindings":{"category":"id"}},"categories.destroy":{"uri":"categories\/{category}","methods":["DELETE"],"parameters":["category"],"bindings":{"category":"id"}},"storage.local":{"uri":"storage\/{path}","methods":["GET","HEAD"],"wheres":{"path":".*"},"parameters":["path"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
