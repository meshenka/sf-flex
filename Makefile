assets: assets-framework
	@echo "Assets built"
.PHONY: assets

assets-framework:
	mkdir -p public/app/bootstrap
	cp -rf ./node_modules/bootstrap/dist/ public/app/bootstrap
.PHONY: assets-framework

